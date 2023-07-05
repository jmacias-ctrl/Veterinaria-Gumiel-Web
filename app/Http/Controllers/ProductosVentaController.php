<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\CategoriasProducto;
use App\Models\User;
use App\Models\productos_ventas;
use App\Models\Marcaproducto;
use App\Models\tipoproductos_ventas;
use DataTables;
use App\Models\trazabilidad_venta_presencial;
use App\Models\efectivo;
use App\Models\transferencia;
use App\Models\tarjeta;
use App\Models\Especie;
use App\Models\items_comprados;
use App\Models\TipoCategorias;
use Database\Seeders\CategoriaProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductosVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_productos(Request $request)
    {
        if ($request->ajax()) {
            $data = productos_ventas::with(['marcaproductos', 'tipoproductos_ventas', 'especies'])->get()->map(function ($producto) {
                $producto->id_marca = $producto->marcaproductos->nombre;
                $producto->id_tipo = $producto->tipoproductos_ventas->nombre;
                $producto->producto_enfocado = $producto->especies->nombre;
                $producto->precio = '$' . number_format($producto->precio, 0, ',', '.');
                return $producto;
            });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'producto.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('producto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MarcaProductos = Marcaproducto::all();
        $categorias = Categorias::all();
        $subcategorias = TipoCategorias::all();
        $TipoProductos = tipoproductos_ventas::all();
        $especies = Especie::all();
        return view('producto.crear', compact('MarcaProductos', 'TipoProductos', 'especies','categorias','subcategorias'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ([
            'nombre' => 'required',
            'codigo' => 'string|required|unique:App\Models\productos_ventas,codigo',
            'marca' => 'required',
            'slug' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'producto_enfocado' => 'required',
            'precio' => 'required|integer|min:1',
            'imagen_path' => 'required|mimes:jpg,jpeg,png',
        ]);
        $attributes = ([
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'codigo' => 'Codigo',
            'slug' => 'Slug',
            'descripcion' => 'Descripcion',
            'min_stock' => 'Minimo Stock',
            'tipo' => 'Tipo',
            'stock' => 'Stock',
            'producto_enfocado' => 'Enfoque del Producto',
            'precio' => 'Precio',
            'imagen_path' => 'Imagen',
        ]);
        $message = ([
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero, ingrese nuevamente',
            'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
            'unique' => ':attribute ya se encuentra registrado',
        ]);

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $imagen_path = $request->file('imagen_path');

            // Crea una instancia de la clase productos_ventas y asigna los valores
            $producto = new productos_ventas();
            $producto->nombre = $request->input('nombre');
            $producto->codigo = $request->input('codigo');
            $producto->id_marca = $request->input('marca');
            $producto->descripcion = $request->input('descripcion');
            $producto->slug = $request->input('slug');
            $producto->min_stock = $request->input('min_stock');
            $producto->id_tipo = $request->input('tipo');
            $producto->stock = $request->input('stock');
            $producto->producto_enfocado = $request->input('producto_enfocado');

            $sub="";
            foreach ($request->request as $key => $req) {
                if (strncmp($key, "subcategoria", 12) === 0){
                    $sub=$sub.$req."-";
                }
            }
            $producto->subcategoria=$sub;


            // $producto->precio = $request->input('precio');
            $producto->precio = $request->input('precio') < 0 ? 1 : $request->input('precio');

            $producto->imagen_path = $imagen_path->store('public/image/productos');
            $filename = time() . '.' . $imagen_path->getClientOriginalExtension();

            // Mueve el archivo cargado a la carpeta public/imagen
            $imagen_path->move(public_path('image/productos'), $filename);

            // Asigna la ruta de la imagen al objeto $producto
            $producto->imagen_path = $filename;
            // Guarda el producto en la base de datos
            $producto->save();

            foreach ($request->request as $key => $req) {
                if (strncmp($key, "subcategoria", 12) === 0){
                    $catPro = new CategoriasProducto();
                    $catPro->id_producto = $producto->id;
                    $catPro->id_categoria = (int)   $req;
                    $catPro->save();
                }
            }

            return redirect()->route('productos.index')->with('success', 'Producto agregado exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = productos_ventas::find($id);
        $MarcaProductos = Marcaproducto::all();
        $TipoProductos = tipoproductos_ventas::all();
        $especies = Especie::all();
        $categorias = Categorias::all();
        $subcategorias = TipoCategorias::all();
        return view('producto.editar', compact('MarcaProductos', 'TipoProductos', 'especies', 'producto','categorias','subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productos_ventas $producto)
    {
        $rules = ([
            'nombre' => 'required',
            'codigo' => [
                'string',
                'required',
                Rule::unique('productos_ventas', 'codigo')->ignore($request->id),
            ],
            'marca' => 'required',
            'slug' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'producto_enfocado' => 'required',
            'precio' => 'required|integer|min:1',
        ]);
        $attributes = ([
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'codigo' => 'Codigo',
            'slug' => 'Slug',
            'descripcion' => 'Descripcion',
            'min_stock' => 'Minimo Stock',
            'tipo' => 'Tipo',
            'stock' => 'Stock',
            'producto_enfocado' => 'Enfoque del Producto',
            'precio' => 'Precio',
        ]);
        $message = ([
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero, ingrese nuevamente',
            'unique' => ':attribute ya se encuentra registrado',
        ]);
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $prod = productos_ventas::find($request->id);
            if (isset($request->imagen_path)) {
                Storage::delete('public/image/productos/' . $prod->imagen_path);
                $imagen = $request->file('imagen_path');
                $rutaGuardarImg = 'image/productos';
                $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($rutaGuardarImg, $imagenProducto);
                $prod->imagen_path = "$imagenProducto";
            }
            $prod->codigo = $request->input('codigo');
            $prod->nombre = $request->input('nombre');
            $prod->id_marca = $request->input('marca');
            $producto->slug = $request->input('slug');
            $producto->min_stock = $request->input('min_stock');
            $prod->descripcion = $request->input('descripcion');
            $prod->id_tipo = $request->input('tipo');
            $prod->stock = $request->input('stock');
            $prod->producto_enfocado = $request->input('producto_enfocado');

            $sub="";
            foreach ($request->request as $key => $req) {
                if (strncmp($key, "subcategoria", 12) === 0){
                    $sub=$sub.$req."-";
                }
            }
            $prod->subcategoria=$sub;

           
            // $prod->precio = $request->input('precio');
            $prod->precio = $request->input('precio') < 0 ? 1 : $request->input('precio');

            $prod->save();

            $categoriaProducto = CategoriasProducto::all()->where('id_producto', '=', $prod->id);
            foreach ($categoriaProducto as $key => $catpro) {
                
                $cp = CategoriasProducto::findOrFail($catpro->id);
                $cp->delete();
            }
            foreach ($request->request as $key => $req) {
                if (strncmp($key, "subcategoria", 12) === 0){
                    $catPro = new CategoriasProducto();
                    $catPro->id_producto = $prod->id;
                    $catPro->id_categoria = (int)   $req;
                    $catPro->save();
                }
            }

            return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $categoriaProducto = CategoriasProducto::all()->where('id_producto', '=', $request->id);
        foreach ($categoriaProducto as $key => $catpro) {
            
            $cp = CategoriasProducto::findOrFail($catpro->id);
            $cp->delete();
        }
        
        $producto = productos_ventas::findOrFail($request->id);
        Storage::delete('public/image/productos/' . $producto->imagen_path);
        $producto->delete();

        

        return response()->json(['success' => true,'id'=>$request->id], 200);
    }
}
