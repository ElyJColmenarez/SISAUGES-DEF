<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\Persona;
use SISAUGES\Models\Estudiante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use SISAUGES\Http\Requests;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estudiante.index');
    }

    public function renderForm(Request $request)
    {
        if ($request->typeform == 'add')
        {
            $action = "estudiante/crear/";
        }
        elseif($request->typeform == 'modify')
        {
            $action = "estudiante/modificar/".$request->field_id;
        }
        elseif ($request->typeform == 'delete')
        {
            $action = "estudiante/eliminar/".$request->field_id;
        }

        $persona = Persona::find($request->cedula);
        $estudiante = Estudiante::find($request->cedula);

        if ($request->typeform == 'delete')
        {
            $fields = false;
        }
        else
        {
            $hiddenfields = array(
                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                )
            );

            $fields = array(


                'cedula'         => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->cedula,
                    'id'            => 'cedula',
                    'label'         => 'Cédula',
                    'validaciones'  => array('solonumeros','obligatorio')),

                'nombre'         => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->nombre,
                    'id'            => 'nombre',
                    'label'         => 'Nombre',
                    'validaciones'  => array(
                        'solocaracteres',
                        'obligatorio')),

                'apellido'       => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->apellido,
                    'id'            => 'apellido',
                    'label'         => 'Apellido',
                    'validaciones'  => array(
                        'solocaracteres',
                        'obligatorio' )),

                'email'          => array(
                    'type'          => 'email',
                    'value'         => (empty($persona))? '' : $persona->email,
                    'id'            => 'email',
                    'label'         => 'Correo Electronico',
                    'validaciones'  => array(
                        'solocorreo',
                        'obligatorio' )), //no lo muestra

                'telefono'       => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->telefono,
                    'id'            => 'telefono',
                    'label'         => 'Teléfono',
                    'validaciones'  => array(
                        'solonumero',
                        'obligatorio' )),

                'carrera' => array(
                    'type'      => 'input',
                    'value'     => (empty($estudiante))? '' : $estudiante->carrera_estudiante,
                    'id'        => 'carrera_estudiante',
                    'label'     => 'Carrera',
                    'validaciones'  => array(
                        'sololetras',
                        'obligatorio' )
                ),

                'semestre' => array(
                    'type'      => 'input',
                    'value'     => (empty($estudiante))? '' : $estudiante->semestre_estudiante,
                    'id'        => 'semestre_estudiante',
                    'label'     => 'Semestre/Trimestre',
                    'validaciones'  => array(
                        'solonumero',
                        'obligatorio' )
                ),

                'Proyecto' => array(
                    'type'      => 'select',
                    'value'     => (empty($estudiante))? '' : $estudiante->id_proyecto,
                    'id'        => 'semestre_estudiante',
                    'label'     => 'Semestre/Trimestre',
                    'options'   => array(
                        ''          =>'Seleccione...',
                        '1'         =>'Informática',
                        '2'         =>'Electricidad',
                        '3'         =>'Tecnología de los materiales',
                        '4'         =>'Quimica')
                ),

                'status' => array(
                    'type'      => 'select',
                    'value'     => (!empty($estudiante->status))? $estudiante->status:'',
                    'id'        => 'status',
                    'label'     => 'Status',
                    'options'   => array(
                        ''=>'Seleccione...',
                        'true' =>'Activo',
                        'false'=>'Inactivo'
                    )
                )
            );
        }

        $htmlBody = View::make('layouts.regularform',compact('action','fields','hiddenfields'))->render();

        if ($htmlBody)
        {
            $retorno = array(
                'result'    => true,
                'html'      => $htmlBody
            );
        }
        else
        {
            $retorno = array('result'   => false);
        }

        echo json_encode($retorno);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('estudiante.crear');
        }

        if ($request->isMethod('post'))
        {
            $persona = Persona::find($request->cedula);
            if (empty($persona))
            {
                $persona = new Persona();

                $persona->cedula    = $request->cedula;
                $persona->nombre    = $request->nombre;
                $persona->apellido  = $request->apellido;
                $persona->email     = $request->email;
                $persona->telefono  = $request->telefono;
                $persona->status    = $request->status;
                $persona->save();

                $estudiante = new Estudiante();

                $estudiante->carrera_estudiante     = $request->carrera_estudiante;
                $estudiante->semestre_estudiante    = $request->semestre_estudiante;
                $estudiante->id_proyecto            = $request->id_proyecto;
                $estudiante->cedula_persona         = $request->cedula;
                $estudiante->status                 = $request->status;
                $val = $estudiante->save();


            }
            else
            {
                $estudiante = new Estudiante();

                $estudiante->carrera_estudiante     = $request->carrera_estudiante;
                $estudiante->semestre_estudiante    = $request->semestre_estudiante;
                $estudiante->id_proyecto            = $request->id_proyecto;
                $estudiante->cedula_persona         = $request->cedula;
                $estudiante->status                 = $request->status;
                $val = $estudiante->save();
            }

            return $val;
        }
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
        $estudiante      = Estudiante::find($id);
        $persona    = Persona::find($estudiante->cedula_persona);

        $persona->cedula    = $request->cedula;
        $persona->nombre    = $request->nombre;
        $persona->apellido  = $request->apellido;
        $persona->email     = $request->email;
        $persona->telefono  = $request->telefono;
        $persona->status    = $request->status;
        $persona->save();


        $estudiante->carrera_estudiante     = $request->carrera_estudiante;
        $estudiante->semestre_estudiante    = $request->semestre_estudiante;
        $estudiante->id_proyecto            = $request->id_proyecto;
        $estudiante->cedula_persona         = $request->cedula;
        $estudiante->status                 = $request->status;
        $val = $estudiante->save();

        return $val;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);

        $estudiante->status = false;

        $val = $estudiante->save();

        return $val;
    }

    public function ajaxRegularStore(Request $request){


        $val=$this->store($request);

        $retorno=array();

        if ($val) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='El registro de los datos fue exitoso...';

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos suministrados no son validos';

        }

        echo json_encode($retorno);

    }

    public function ajaxRegularUpdate(Request $request, $id){

        $val=$this->update($request,$id);

        $retorno=array();

        if ($val) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='El registro de los datos fue exitoso...';

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos suministrados no son validos';

        }

        echo json_encode($retorno);

    }

    public function ajaxRegularDestroy($id){

        $val=$this->destroy($id);

        $retorno=array();

        if ($val) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='El registro de los datos fue exitoso...';

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos suministrados no son validos.';

        }

        echo json_encode($retorno);

    }
}
