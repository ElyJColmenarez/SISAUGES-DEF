<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;

use SISAUGES\Models\Auditoria;

use Illuminate\Support\Facades\View;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $auditoria=Auditoria::moduloauditoria($request->modulo)->/*whereHas('departamento', function($query) use ($request){

                $query->descripciondepartamento('');

        })->*/orderBy('modulo', 'desc')->paginate(20);

       // dd($auditoria);    
    
        $action="auditoria/listar";

        $fields=array(

            'modulo' => array(
                'type'  => 'text',
                'value' => (isset($request->modulo))? $request->modulo:'',
                'id'    => 'modulo',
                'label' => 'modulo de la auditoria'
            ),
            'operacion' => array(
                'type'  => 'text',
                'value' => (isset($request->operacion))? $request->operacion:'',
                'id'    => 'operacion',
                'label' => 'operacion'
            ),
            'descripcion' => array(
                'type'  => 'text',
                'value' => (isset($request->descripcion))? $request->descripcion:'',
                'id'    => 'descripcion',
                'label' => 'descripcion'
            ),
            'usuario' => array(
                'type'  => 'text',
                'value' => (isset($request->usuario))? $request->usuario:'',
                'id'    => 'usuario',
                'label' => 'Usuario del sistema'
            ),

            'fecha' => array(
                'type'  => 'text',
                'value' => (isset($request->fecha))? $request->fecha:'',
                'id'    => 'fecha',
                'label' => 'fecha'
            )
        );

        $data=array(

            'title'=>'Auditoria',
            'principal_search'=>'modulo',
            'registros'=>$auditoria,
            'carpeta'=>'auditoria'

        );

        return view('layouts.indexAut',compact('data','action','fields','request'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function store($modulo, $operacion, $descripcion, $usuario)
    {
        //
        $auditoria= new Auditoria();
        $auditoria->modulo=$modulo;
        $auditoria->operacion=$operacion;
        $auditoria->descripcion=$descripcion;
        $auditoria->usuario=$usuario;
        $date = date('Y-m-d H:i:s');
        $auditoria->fecha=$date;
        $val=$auditoria->save();
        return $val;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
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


}
