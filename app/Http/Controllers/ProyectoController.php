<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;
use SISAUGES\Models\Institucion;
use SISAUGES\Models\Departamento;

use Illuminate\Support\Facades\View;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {

        $instituciones=Institucion::nombreinstitucion($request->nombre_institucion)->/*whereHas('departamento', function($query) use ($request){

                $query->descripciondepartamento('');

        })->*/orderBy('nombre_institucion', 'desc')->paginate(20);

        $action="institucion/listar";

        $fields=array(

            'nombre_institucion' => array(
                'type'  => 'text',
                'value' => (isset($request->nombre_institucion))? $request->nombre_institucion:'',
                'id'    => 'nombre_institucion',
                'label' => 'Nombre de la institucion'
            ),
            'correo_institucional' => array(
                'type'  => 'text',
                'value' => (isset($request->correo_institucional))? $request->correo_institucional:'',
                'id'    => 'correo_institucional',
                'label' => 'Correo de la institucion'
            ),
            'direccion_institucion' => array(
                'type'  => 'text',
                'value' => (isset($request->direccion_institucion))? $request->direccion_institucion:'',
                'id'    => 'direccion_institucion',
                'label' => 'Direccion de la institucion'
            ),
            'telefono_institucion' => array(
                'type'  => 'text',
                'value' => (isset($request->telefono_institucion))? $request->telefono_institucion:'',
                'id'    => 'telefono_institucion',
                'label' => 'Telefono de la institucion'
            ),
            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus:'',
                'id'        => 'estatus',
                'label'     => 'estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
                    '0'=>'Inactivo'
                )
            )
        );

        $data=array(

            'title'=>'Instituciones',
            'principal_search'=>'nombre_institucion',
            'registros'=>$instituciones,
            'carpeta'=>'proyecto'

        );

        return view('proyecto.proyecto',compact('data','action','fields','request'));
        
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
