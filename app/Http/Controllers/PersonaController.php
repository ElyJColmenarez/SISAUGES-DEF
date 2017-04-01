<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use SISAUGES\Http\Requests;
use SISAUGES\Models\Persona;

class PersonaController extends Controller
{
    public function store(Request $request)
    {
        $persona = New Persona($request->all());
        $persona->cedula = \Crypt::encrypt($request->cedula);
        $persona->save();
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::find($id);
        $persona->cedula=\Crypt::encrypt($request->cedula);
        $persona->nombre=$request->nombre;
        $persona->apellido=$request->apellido;
        $persona->email=$request->email;
        $persona->telefono=$request->telefono;
        $persona->estatus = $request->estatus;

        $persona->save();

    }

    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->estatus = false ;
        $persona->save();
    }
}
