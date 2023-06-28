<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\productos_ventas;
use Spatie\Permission\Models\Role;
use App\Models\trazabilidad_venta_presencial;
use App\Models\items_comprados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Transbank\Webpay\WebpayPlus\Transaction;
use Carbon\Carbon;
use App\Notifications\StockProductoInventario;

use Illuminate\Support\Facades\Mail;
use App\Mail\ComprobanteDePago;

use Illuminate\Support\Facades\DB;
use DataTables;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartCollection = \Cart::getContent();
        foreach ($cartCollection as $item) {
            $item['stock'] = productos_ventas::find($item->id)->stock;
        }
        return view('shop.checkout.checkout')->withTitle('GUMIEL TIENDA | CHECKOUT')->with(['cartCollection' => $cartCollection]);
    }

    public function resumen_compra(Request $request)
    {
        $cartCollection = \Cart::getContent();
        $trazabilidad = new trazabilidad_venta_presencial();
        $trazabilidad->id_venta = Str::random(10);
        $trazabilidad->metodo_pago = 'online';
        $trazabilidad->nombre_cliente = "compra online";
        $trazabilidad->fecha_compra = Carbon::now()->toDateString();
        $trazabilidad->save();

        $items_comprados = array();

        foreach ($cartCollection as $item) {
            $item['stock'] = productos_ventas::find($item->id)->stock;
            $newItem = new items_comprados();
            $newItem->monto = $item->price;
            $newItem->cantidad = $item->quantity;
            $newItem->id_producto = $item->id;
            $newItem->id_venta = $trazabilidad->id;
            $newItem->tipo_item = "producto";
            $newItem->save();
            $producto = productos_ventas::find($item->id);
            $producto->stock = $producto->stock - $item->quantity;
            if ($producto->stock <= 0) {
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->can('acceso administracion de stock')) {
                        $user->notify(new StockProductoInventario($producto, true));
                    }
                }
            } else if ($producto->stock < $producto->min_stock) {
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->can('acceso administracion de stock')) {
                        $user->notify(new StockProductoInventario($producto, false));
                    }
                }
            }

            $_item = [
                'id' => $item->id,
                'name' => $producto->nombre,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'attributes' => $item->attributes,
                'stock' => $producto->stock,];

            array_push($items_comprados, $_item);

            $producto->save();
        }

        $response = (new Transaction)->status($request->token);
        $compra = Compra::find($response->buyOrder);
        $compra->token = $request->token;
        $compra->status = $response->status;
        $compra->save();
        $a = "ids = ";
        foreach ($cartCollection as $item) {
            $venta = productos_ventas::find($item->id);
            $venta->stock = $venta->stock - $item->quantity;
            $venta->save();
        }

        $user = auth()->user();

        $fecha = Carbon::now()->toDateString();
        $hora = Carbon::now()->toTimeString();

        //Generar el PDF
        $pdf = \PDF::loadView('pdf.comprobante-pago', compact('response', 'cartCollection', 'user', 'items_comprados', 'fecha', 'hora'));

        $data = [
            'response' => $response,
            'cartCollection' => $cartCollection,
            'user' => $user,
        ];
        
        $correo = new ComprobanteDePago($data);
        $correo->attachData($pdf->output(), 'comprobante.pdf');
        Mail::to($user->email)->send($correo);

        return view('shop.checkout.resumen-compra')->with(['response' => $response])->with(['cartCollection' => $cartCollection])->with(['user' => $user]);
    }

    public function finish($status_finish)
    {
        if (!$status_finish) {
            \Cart::clear();
            return redirect()->route('shop.shop');
        } else {
            return redirect()->route('shop.checkout.checkout');
        }
    }

    public function login()
    {
        return view('shop.checkout.login')->withTitle('GUMIEL TIENDA | CHECKOUT');
    }

    public function registro_invitado()
    {
        return view('shop.checkout.registro_invitado')->withTitle('GUMIEL TIENDA | CHECKOUT');
    }

    public function login_shop(Request $request)
    {
        $rules = [
            'email'  => 'required|email',
            'password' => 'required|min:7' //cambiar a 8 (para probar cliente demo)
        ];
        $attributes = [
            'email' => 'Correo',
            'password' => 'Contraseña',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'min' => ':attribute invalida, debe ser minimo :min.',
            'email' => ':attribute invalida, ingrese :attribute nuevamente.'
        ];

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                return back()->withErrors(['message' => 'Email o Contraseña incorrectos, vuelva a intentarlo.']);
            }
            return redirect()->route('shop.checkout.checkout');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function registro_invitado_shop(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'rut'  => 'required|string|max:10',
            'email_register'  => 'required|email',
            'telefono' => 'required|digits:9'
        ];
        $attributes = [
            'nombre' => 'Nombre',
            'rut' => 'Rut',
            'email_register' => 'Correo',
            'telefono' => 'Teléfono',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
            'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
            'max' => ':attribute invalido, debe ser máximo :max',
            'email' => ':attribute invalido, ingrese :attribute nuevamente'
        ];

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            try {
                db::beginTransaction();
                $role = Role::where('name', '=', 'Invitado')->get();
                $rol = array(
                    $role[0]->id => $role[0]->name
                );
                $user = new User;
                $user->name = $request->nombre;
                $user->rut =  $request->rut;
                $user->email = $request->email_register;
                $user->phone = $request->telefono;
                $user->save();
                db::commit();
                $user->assignRole($rol);
                auth()->login($user);
                return redirect()->route('shop.checkout.checkout');
            } catch (QueryException $exception) {
                DB::rollBack();
                return back()->withInput();
            }
        }
        return back()->withErrors($validator)->withInput();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompraRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraRequest  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
