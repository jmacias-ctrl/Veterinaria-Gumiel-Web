<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\productos_ventas;
use Illuminate\Http\Request;

class ProductosVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_productos()
{
    $productos = productos_ventas::all();
    return view('producto.index', ['productos' => $productos]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.crear');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required', 
            'marca' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required', 
            'stock' => 'required',
            'producto_enfocado' => 'required',
            'precio' => 'required',
            'imagen_path' => 'required|image',
        ]);
    
        $imagen_path = $request->file('imagen_path');
    
        // Crea una instancia de la clase productos_ventas y asigna los valores
        $producto = new productos_ventas();
        $producto->nombre = $request->input('nombre');
        $producto->marca = $request->input('marca');
        $producto->descripcion = $request->input('descripcion');
        $producto->tipo = $request->input('tipo');
        $producto->stock = $request->input('stock');
        $producto->producto_enfocado = $request->input('producto_enfocado');
        $producto->precio = $request->input('precio');
        $producto->imagen_path = $imagen_path->store('public/imagen');
        $filename = time() . '.' . $imagen_path->getClientOriginalExtension();

// Mueve el archivo cargado a la carpeta public/imagen
$imagen_path->move(public_path('imagen'), $filename);

// Asigna la ruta de la imagen al objeto $producto
$producto->imagen_path = $filename;
        // Guarda el producto en la base de datos
        $producto->save();
    
        return redirect('admin/productos')->with('success', 'Producto agregado exitosamente');
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
    public function edit(productos_ventas $producto)
    {
       // dd($producto->id);
        return view('producto.editar', compact('producto'));
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
        $request->validate([
            'nombre' => 'required', 'marca' => 'required','descripcion' => 'required','tipo' => 'required', 'stock' => 'required','producto_enfocado' => 'required','precio' => 'required'
        ]);
         $prod = $request->all();
         if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension(); 
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $prod['imagen'] = "$imagenProducto";
         }else{
            unset($prod['imagen']);
         }
         $producto->update($prod);
         
         return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
{
    $producto = productos_ventas::findOrFail($id);
    $producto->delete();

    return redirect('admin/productos')->with('success', 'Producto eliminado exitosamente');
}

}
  
