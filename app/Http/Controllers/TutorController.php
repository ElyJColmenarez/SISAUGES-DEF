<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\Persona;
use SISAUGES\Models\Tutor;
use SISAUGES\Models\Departamento;
use SISAUGES\Models\institucion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use SISAUGES\Http\Requests;

class TutorController extends Controller
{



    public function fieldsRegisterCall($persona,$tutor,$instituciones,$departamentos){

        $fields = array(


            'cedula'         => array(
                'type'          => (empty($persona))? 'text' : 'label',
                'value'         => (empty($persona))? '' : $persona[0]->cedula,
                'id'            => 'cedula',
                'label'         => 'Cédula',
                'validaciones'  => array('solonumeros','obligatorio'),
                'valshow'=>(empty($persona))? '' : $persona[0]->cedula,
                'valkey'=>'cedula'
            ),

            'nombre'         => array(
                'type'          => 'text',
                'value'         => (empty($persona))? '' : $persona[0]->nombre,
                'id'            => 'nombre',
                'label'         => 'Nombre',
                'validaciones'  => array(
                    'solocaracteres',
                    'obligatorio')),

            'apellido'       => array(
                'type'          => 'text',
                'value'         => (empty($persona))? '' : $persona[0]->apellido,
                'id'            => 'apellido',
                'label'         => 'Apellido',
                'validaciones'  => array(
                    'solocaracteres',
                    'obligatorio' )),

            'email'          => array(
                'type'          => 'email',
                'value'         => (empty($persona))? '' : $persona[0]->email,
                'id'            => 'email',
                'label'         => 'Correo Electronico',
                'validaciones'  => array(
                    'solocorreo',
                    'obligatorio' )), //no lo muestra

            'telefono'       => array(
                'type'          => 'text',
                'value'         => (empty($persona))? '' : $persona[0]->telefono,
                'id'            => 'telefono',
                'label'         => 'Teléfono',
                'validaciones'  => array(
                    'solonumero',
                    'obligatorio' )),

            'separador2'=>array('type'=>'separador'),

            'departamento' => array(

                'type'      => 'select',
                'value'     => (isset($departamentos[0]->id_departamento))? $departamentos[0]->id_departamento:'',
                'id'        => 'id_departamento',
                'label'     => 'Departamento',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_departamento','descripcion_departamento'),
                'options'   => $departamentos[1],
                'selectadd' => array(
                    'btnlabel'=>'Registrar Departamento',
                    'btnfinlavel'=>'Registrar Departamento',
                    'url'=> url('departamento/registerform')
                )

            )


        );

        return $fields;
    }

    public function fieldsSearchCall($request,$departamentos){

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


            'descripcion_departamento'=>array(

                'type'      => 'select',
                'value'     => (!empty($request->descripcion_departamento))? $request->descripcion_departamento:'',
                'id'        => 'id_departamento',
                'label'     => 'Departamento',
                'selecttype'=> 'obj',
                'values_seting'=> $departamentos,
                'objkeys'   => array('descripcion_departamento','descripcion_departamento'),
                'options'   => $departamentos

            ),

            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus:'',
                'id'        => 'estatus',
                'label'     => 'estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1' =>'Activo',
                    '0'=>'Inactivo'
                )
            )
        );

        return $fields;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tutor = Tutor::with('persona')->
        cedulaTutor($request->cedula)->
        statustutor($request->estatus)->
        whereHas('departamento', function($query) use ($request){

                $query->descripciondepartamento($request->descripcion_departamento);

        })->
        whereHas('persona', function($query) use ($request){

                $query->nombrepersona($request->nombre)->
                        apellidopersona($request->apellido)->
                        emailpersona($request->email)->
                        telefonopersona($request->telefono);

        })->
        orderBy('cedula_persona','asc')->paginate(20);

        $action = "tutor/listar";

        $dp=Departamento::statusdepartamento(1)->get();

        $fields = $this->fieldsSearchCall($request,$dp);

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

            $departamentos= Departamento::find($tutor->id_departamento);

            $instituciones= Institucion::find($departamentos->id_institucion);

            //$persona = Persona::find($persona[0]->id_persona);
        }else{

            $persona = Persona::find($request->field_id);

            $departamentos= Departamento::find($request->field_id);

            $instituciones= Institucion::find($request->field_id);
        }


        if ($request->typeform == 'delete')
        {
            $fields = false;
            $modulo='Tutor';

            $hiddenfields = array(
                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
                'extra_url'=>array(
                    'type'  => 'hidden',
                    'value' =>  url('tutor/registerform'),
                    'id'    => 'extra_url',
                )
            );
        }
        else
        {
            $hiddenfields = array(
                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
                'extra_url'=>array(
                    'type'  => 'hidden',
                    'value' =>  url('tutor/registerform'),
                    'id'    => 'extra_url',
                )
            );

            $dp=Departamento::statusdepartamento(1)->get();
            $ins=institucion::statusinstitucion(1)->get();

            $fields = $this->fieldsRegisterCall($persona,$tutor,array($instituciones,$ins),array($departamentos,$dp));

            $modulo='Tutor';

        }

        $htmlBody = View::make('layouts.regularform',compact('action','fields','hiddenfields','request','modulo'))->render();

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

        $persona = Persona::buscarpersona($request->cedula)->get();
        if (!isset($persona[0]))
        {
            $persona = new Persona();

            $persona->cedula    = $request->cedula;
            $persona->nombre    = $request->nombre;
            $persona->apellido  = $request->apellido;
            $persona->email     = $request->email;
            $persona->telefono  = $request->telefono;
            $persona->estatus    = 1;
            $persona->save();

            $tutor = new Tutor();

            $tutor->id_departamento     = $request->departamento;
            $tutor->cedula_persona      = $request->cedula;
            $tutor->estatus              = 1;
            $val = $tutor->save();


        }
        else
        {
            $tutor = new Tutor();

            $tutor->id_departamento     = $request->departamento;
            $tutor->cedula_persona      = $request->cedula;
            $tutor->estatus              = 1;
            $val = $tutor->save();
        }


        

        return array('result'=>$val,'obj'=>$tutor->id_tutor,'keystone'=>'id_tutor');
        
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
        $persona->estatus    = 1;
        $persona->save();


        $tutor->id_departamento     = $request->departamento;
        $tutor->cedula_persona      = $request->cedula;
        $tutor->estatus              = $request->estatus;
        $val = $tutor->save();

        return array('result'=>$val,'obj'=>$tutor->id_tutor,'keystone'=>'id_tutor');
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

        $persona->estatus = false;
        $tutor->estatus = false;

        $persona->save();
        $val = $tutor->save();

        return array('result'=>$val,'obj'=>$tutor->id_tutor,'keystone'=>'id_tutor');
    }

    public function ajaxRegularStore(Request $request){

        $val=$this->store($request);

        $retorno=array();

        if ($val['result']) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='El registro de los datos fue exitoso...';
            $retorno['obj']=$val['obj'];
            $retorno['keystone']=$val['keystone'];

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

        if ($val['result']) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='Actualizacion de registro de los datos fue exitoso...';
            $retorno['obj']=$val['obj'];
            $retorno['keystone']=$val['keystone'];

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos suministrados no son validos';

        }

        echo json_encode($retorno);

    }

    public function ajaxRegularDestroy(Request $request,$id){

        $val=$this->destroy($id);

        $retorno=array();

        if ($val['result']) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='Desactivo fue exitoso...';
            $retorno['obj']=$val['obj'];
            $retorno['keystone']=$val['keystone'];

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos suministrados no son validos.';

        }

        echo json_encode($retorno);

    }
}
