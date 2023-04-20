<?php

namespace App\Http\Controllers;

use App\Models\productos_venta;
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
        $productos=productos_venta::all();
        return view("producto.ingresar_producto",['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $producto= new productos_venta();
        $producto->nombre=$request->nombre;
        $producto->marca=$request->marca;
        $producto->descripcion=$request->descripcion;
        $producto->tipo=$request->tipo;
        $producto->stock=$request->stock;
        $producto->producto_enfocado=$request->producto_enfocado;
        $producto->precio=$request->precio;



     $producto->save();
     return redirect()->route('productos.index');
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $producto= productos_venta::findOrFail($request->id);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto= productos_venta::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
