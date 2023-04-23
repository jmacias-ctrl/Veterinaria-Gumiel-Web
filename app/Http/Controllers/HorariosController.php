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

    public function add()
    {
        $users = User::all();
        return view('admin.horario.add', compact('users'));
    }
    
    public function store(Request $request )
    {
        $horarios = new Horarios;
        $horarios->title = $request->input('title');
        $horarios->id_usuario = $request->input('id_usuario');
        $horarios->start = $request->input('start');
        $horarios->end = $request->input('end');

        $horarios->save();
        return Redirect()->route('admin.horario.index');
       
    }

    public function show(Horarios $horarios)
    {
        $data['horarios']=Horarios::all();
        return response()->json($data['horarios']);
    }
    public function edit(Horarios $horarios)
    {
        //
    }

    public function update(Request $request, Horarios $horarios)
    {
        //
    }

    public function destroy(Horarios $horarios)
    {
        //
    }
}
