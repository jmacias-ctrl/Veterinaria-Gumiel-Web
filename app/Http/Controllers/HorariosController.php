<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Use\assignUser;


class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.horario.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $users = User::all();
        return view('admin.horario.add', compact('users'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $horarios = new Horarios;
        $horarios->id_usuario = $request->input('id_usuario');
        $horarios->dia = $request->input('dia');
        $horarios->start = $request->input('start');
        $horarios->end = $request->input('end');

        $horarios->save();
        return Redirect()->route('admin.horario.index');
       
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function show(Horarios $horarios)
    {
        $horarios = Horarios::all();
        return response()->json($horarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Horarios $horarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horarios $horarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horarios $horarios)
    {
        //
    }
}
