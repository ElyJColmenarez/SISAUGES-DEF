<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\Persona;
use SISAUGES\Models\Tutor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use SISAUGES\Http\Requests;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tutor = Tutor::with('persona')->cedulaTutor($request->cedula)->orderBy('cedula_persona','asc')->paginate(20);

        $action = "tutor/listar";

        $fields = array(


            'cedula'         => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->cedula,
                'id'            => 'cedula',
                'label'         => 'Cédula',
                'validaciones'  => array('solonumeros','obligatorio')),

            'nombre'         => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->nombre,
                'id'            => 'nombre',
                'label'         => 'Nombre',
                'validaciones'  => array(
                    'solocaracteres',
                    'obligatorio')),

            'apellido'       => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->apellido,
                'id'            => 'apellido',
                'label'         => 'Apellido',
                'validaciones'  => array(
                    'solocaracteres',
                    'obligatorio' )),

            'email'          => array(
                'type'          => 'email',
                'value'         => (empty($request))? '' : $request->email,
                'id'            => 'email',
                'label'         => 'Correo Electronico',
                'validaciones'  => array(
                    'solocorreo',
                    'obligatorio' )), //no lo muestra

            'telefono'       => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->telefono,
                'id'            => 'telefono',
                'label'         => 'Teléfono',
                'validaciones'  => array(
                    'solonumero',
                    'obligatorio' )),

            'institucion' => array(
                'type'      => 'select',
                'value'     => (isset($request->institucion))? $request->institucion:'',
                'id'        => 'status',
                'label'     => 'Status',
                'options'   => array(
                    ''=>'Seleccione...',
                    'true' =>'Activo',
                    'false'=>'Inactivo'
                )
            ),

            'id_departamento' => array(
                'type'      => 'select',
                'value'     => (isset($request->id_departamento))? $request->id_departamento:'',
                'id'        => 'departamento',
                'label'     => 'Departamento',
                'options'   => array(
                    ''          =>'Seleccione...',
                    '1'         =>'Informática',
                    '2'         =>'Electricidad',
                    '3'         =>'Tecnología de los materiales',
                    '4'         =>'Quimica',

                )
            ),

            'status' => array(
                'type'      => 'select',
                'value'     => (isset($request->status))? $request->status:'',
                'id'        => 'status',
                'label'     => 'Status',
                'options'   => array(
                    ''=>'Seleccione...',
                    'true' =>'Activo',
                    'false'=>'Inactivo'
                )
            )
        );

        $data=array(

            'title'             => 'Tutores',
            'principal_search'  => 'cedula_persona',
            'registros'         => $tutor,
            'carpeta'           => 'tutor'

        );





        return view('layouts.index',compact('data','action','fields','request'));
    }

    public function renderForm(Request $request)
    {
        if ($request->typeform == 'add')
        {
            $action = "tutor/crear/";
        }
        elseif($request->typeform == 'modify')
        {
            $action = "tutor/editar/".$request->field_id;
        }
        elseif ($request->typeform == 'delete')
        {
            $action = "tutor/eliminar/".$request->field_id;
        }


        $tutor = Tutor::find($request->field_id);
        if (isset($tutor)){

            $persona = Persona::buscarpersona($tutor->cedula_persona)->get();
            $persona = Persona::find($persona[0]->id_persona);
        }


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

                'institucion' => array(
                    'type'      => 'select',
                    'value'     => '', //decidir como llamar las instituciones
                    'id'        => 'institucion',
                    'label'     => 'Institución',
                    'options'   => array(
                        ''          =>'Seleccione...',
                        '1'         =>'IUT',
                        '2'         =>'UCV',
                        '3'         =>'UNEFA'
                    )
                ),

                'departamento' => array(
                    'type'      => 'select',
                    'value'     => '', //decidir como llamar los departamentos
                    'id'        => 'departamento',
                    'label'     => 'Departamento',
                    'options'   => array(
                        ''          =>'Seleccione...',
                        '1'         =>'Informática',
                        '2'         =>'Electricidad',
                        '3'         =>'Tecnología de los materiales',
                        '4'         =>'Quimica',

                    )
                ),

                'status' => array(
                    'type'      => 'select',
                    'value'     => (!empty($tutor->status))? $tutor->status:'',
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
            return view('tutor.crear');
        }

        if ($request->isMethod('post'))
        {
            $persona = Persona::buscarpersona($request->cedula)->get();
            if (!isset($persona[0]))
            {
                $persona = new Persona();

                $persona->cedula    = $request->cedula;
                $persona->nombre    = $request->nombre;
                $persona->apellido  = $request->apellido;
                $persona->email     = $request->email;
                $persona->telefono  = $request->telefono;
                $persona->status    = $request->status;
                $persona->save();

                $tutor = new Tutor();

                $tutor->id_departamento     = $request->departamento;
                $tutor->cedula_persona      = $request->cedula;
                $tutor->status              = $request->status;
                $val = $tutor->save();


            }
            else
            {
                $tutor = new Tutor();

                $tutor->id_departamento     = $request->departamento;
                $tutor->cedula_persona      = $request->cedula;
                $tutor->status              = $request->status;
                $val = $tutor->save();
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
        $tutor      = Tutor::find($id);
        $persona    = Persona::buscarpersona($tutor->cedula_persona)->get();
        $persona    = Persona::find($persona[0]->id_persona);

        $persona->cedula    = $request->cedula;
        $persona->nombre    = $request->nombre;
        $persona->apellido  = $request->apellido;
        $persona->email     = $request->email;
        $persona->telefono  = $request->telefono;
        $persona->status    = $request->status;
        $persona->save();


        $tutor->id_departamento     = $request->departamento;
        $tutor->cedula_persona      = $request->cedula;
        $tutor->status              = $request->status;
        $val = $tutor->save();

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
        $tutor = Tutor::find($id);
        $persona = Persona::buscarpersona($tutor->cedula_persona)->get();
        $persona = Persona::find($persona[0]->id_persona);

        $persona->status = false;
        $tutor->status = false;

        $persona->save();
        $val = $tutor->save();

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
