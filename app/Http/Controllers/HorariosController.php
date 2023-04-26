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
        $users = User::all();
        return view('admin.horario.index',compact('users'));
    }

    public function add()
    {
        $users = User::all();
        return view('admin.horario.add', compact('users'));
    }
    
    public function store(Request $request )
    {
        $rules =[
            'title'=>'required',
            'id_usuario'=>'required',
            'start'=>'required',
            'end'=>'required'
        ];
        $attributes = [
            'title'=>'title',
            'id_usuario'=>'id_usuario',
            'start'=>'start',
            'end'=>'end'
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $horarios = new Horarios;
            // $horarios->id = $request->input('id');
            $horarios->title = $request->input('title');
            $horarios->id_usuario = $request->input('id_usuario');
            $horarios->start = $request->input('start');
            $horarios->end = $request->input('end');

            $horarios->save();
            return redirect()->route('admin.horario.index')->with('success', 'El horario ' . $request->title . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
       
    }

    public function show(Horarios $horarios)
    {
        $data['horarios']=Horarios::all();
        return response()->json($data['horarios']);
    }

    public function edit($id)
    {
        $horarios = Horarios::find($id);
        return response()->json($horarios);
    }

    public function delete($id)
    {
        $horarios = Horarios::find($id)->delete();
        return response()->json($horarios);
    }

    public function update(Request $request, Horarios $horarios)
    {
        request()->validate(Horarios::$rules);
        $horarios->update($request->all());
        return response()->json($horarios);
    }

    
}
