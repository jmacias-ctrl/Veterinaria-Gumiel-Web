<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\productos_ventas;
use App\Models\Marcaproducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductosVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_productos()
    {
        $MarcaProductos = Marcaproducto::all();
        $productos = productos_ventas::with('MarcaProductos')->get();

        return view('producto.index', compact('MarcaProductos', 'productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MarcaProductos = Marcaproducto::all();
        return view('producto.crear', compact('MarcaProductos'));
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
            'marca' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'stock' => 'required|integer',
            'producto_enfocado' => 'required',
            'precio' => 'required|integer',
            'imagen_path' => 'required|mimes:jpg,jpeg,png',
        ]);
        $attributes = ([
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'descripcion' => 'Descripcion',
            'tipo' => 'Tipo',
            'stock' => 'Stock',
            'producto_enfocado' => 'Enfoque del Producto',
            'precio' => 'Precio',
            'imagen_path' => 'Imagen',
        ]);
        $message = ([
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero, ingrese nuevamente',
            'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg'
        ]);
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $imagen_path = $request->file('imagen_path');

            // Crea una instancia de la clase productos_ventas y asigna los valores
            $producto = new productos_ventas();
            $producto->nombre = $request->input('nombre');
            $producto->id_marca = $request->input('marca');
            $producto->descripcion = $request->input('descripcion');
            $producto->tipo = $request->input('tipo');
            $producto->stock = $request->input('stock');
            $producto->producto_enfocado = $request->input('producto_enfocado');
            $producto->precio = $request->input('precio');
            $producto->imagen_path = $imagen_path->store('public/image/productos');
            $filename = time() . '.' . $imagen_path->getClientOriginalExtension();

            // Mueve el archivo cargado a la carpeta public/imagen
            $imagen_path->move(public_path('image/productos'), $filename);

            // Asigna la ruta de la imagen al objeto $producto
            $producto->imagen_path = $filename;
            // Guarda el producto en la base de datos
            $producto->save();

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
        $MarcaProductos = Marcaproducto::all();
        return view('producto.editar', compact('MarcaProductos', 'producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = ([
            'nombre' => 'required',
            'id_marca' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'stock' => 'required|integer',
            'producto_enfocado' => 'required',
            'precio' => 'required|integer',
            'imagen_path' => 'mimes:jpg,jpeg,png',
        ]);
        $attributes = ([
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'descripcion' => 'Descripcion',
            'tipo' => 'Tipo',
            'stock' => 'Stock',
            'producto_enfocado' => 'Enfoque del Producto',
            'precio' => 'Precio',
            'imagen_path' => 'Imagen',
        ]);
        $message = ([
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero, ingrese nuevamente',
            'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg'
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
            $prod->nombre = $request->input('nombre');
            $prod->id_marca = $request->input('id_marca');
            $prod->descripcion = $request->input('descripcion');
            $prod->tipo = $request->input('tipo');
            $prod->stock = $request->input('stock');
            $prod->producto_enfocado = $request->input('producto_enfocado');
            $prod->precio = $request->input('precio');
            $prod->save();
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
        $producto = productos_ventas::findOrFail($request->id);
        Storage::delete('public/image/productos/' . $producto->imagen_path);
        $producto->delete();

        return response()->json(['success' => true], 200);
    }
}
