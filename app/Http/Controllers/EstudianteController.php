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

    public function fieldsRegisterCall($persona,$estudiante){

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

            'carrera_estudiante' => array(
                'type'      => 'text',
                'value'     => (empty($estudiante))? '' : $estudiante->carrera_estudiante,
                'id'        => 'carrera_estudiante',
                'label'     => 'Carrera',
                'validaciones'  => array(
                    'sololetras',
                    'obligatorio' )
            ),

            'semestre_estudiante' => array(
                'type'      => 'text',
                'value'     => (empty($estudiante))? '' : $estudiante->semestre_estudiante,
                'id'        => 'semestre_estudiante',
                'label'     => 'Semestre/Trimestre',
                'validaciones'  => array(
                    'solonumero',
                    'obligatorio' )
            ),

            'id_proyecto' => array(
                'type'      => 'select',
                'value'     => (empty($estudiante))? '' : $estudiante->id_proyecto,
                'id'        => 'id_proyecto',
                'label'     => 'Proyecto',
                'options'   => array(
                    ''          =>'Seleccione...',
                    '1'         =>'Informática',
                    '2'         =>'Electricidad',
                    '3'         =>'Tecnología de los materiales',
                    '4'         =>'Quimica')
            ),

            'estatus' => array(
                'type'      => 'select',
                'value'     => (!empty($estudiante->estatus))? $estudiante->estatus:'',
                'id'        => 'estatus',
                'label'     => 'estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    'true' =>'Activo',
                    'false'=>'Inactivo'
                )
            )
        );

        return $fields;
    }

    public function fieldsSearchCall($request){

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

            'carrera_estudiante' => array(
                'type'      => 'select',
                'value'     => (isset($request->carrera_estudiante))? $request->carrera_estudiante:'',
                'id'        => 'carrera_estudiante',
                'label'     => 'Carrera',
                'options'   => array(
                    ''          =>'Seleccione...',
                    '1'         =>'Informática',
                    '2'         =>'Electricidad',
                    '3'         =>'Tecnología de los materiales',
                    '4'         =>'Quimica')
                ),

            'semestre_estudiante' => array(
                'type'      => 'select',
                'value'     => (isset($request->carrera_estudiante))? $request->carrera_estudiante:'',
                'id'        => 'semestre_estudiante',
                'label'     => 'Semestre/Trimestre',
                'options'   => array(
                    ''          =>'Seleccione...',
                    '1'         =>'1',
                    '2'         =>'2',
                    '3'         =>'3',
                    '4'         =>'4')
            ),

            'id_proyecto' => array(
                'type'      => 'select',
                'value'     => (isset($request->id_proyecto))? $request->id_proyecto:'',
                'id'        => 'id_proyecto',
                'label'     => 'Proyecto',
                'options'   => array(
                    ''          =>'Seleccione...',
                    '1'         =>'1',
                    '2'         =>'2',
                    '3'         =>'3',
                    '4'         =>'4')
            ),

            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus:'',
                'id'        => 'estatus',
                'label'     => 'estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    'true' =>'Activo',
                    'false'=>'Inactivo'
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
        $estudiante = Estudiante::with('persona')->cedulaEstudiante($request->cedula)->orderBy('cedula_persona','asc')->paginate(20);

        $action = "estudiante/listar";

        $fields = $this->fieldsSearchCall($request);

        $data=array(

            'title'             => 'Estudiantes',
            'principal_search'  => 'cedula_persona',
            'registros'         => $estudiante,
            'carpeta'           => 'estudiante'

        );





        return view('layouts.index',compact('data','action','fields','request'));
    }

    public function renderForm(Request $request)
    {
        if ($request->typeform == 'add')
        {
            $action = "estudiante/crear/";
        }
        elseif($request->typeform == 'modify')
        {
            $action = "estudiante/editar/".$request->field_id;
        }
        elseif ($request->typeform == 'delete')
        {
            $action = "estudiante/eliminar/".$request->field_id;
        }


        $estudiante = Estudiante::find($request->field_id);

        if (isset($estudiante)){

            $persona = Persona::buscarpersona($estudiante->cedula_persona)->get();

            //$persona = Persona::find($persona[0]->id_persona);
        }else{

            $persona = Persona::find($request->field_id);

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

            $fields = $this->fieldsRegisterCall($persona,$estudiante);
            $modulo='Estudiante';
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
            $persona->estatus    = $request->estatus;
            $persona->save();

            $estudiante = new Estudiante();

            $estudiante->carrera_estudiante     = $request->carrera_estudiante;
            $estudiante->semestre_estudiante    = $request->semestre_estudiante;
            $estudiante->id_proyecto            = $request->id_proyecto;
            $estudiante->cedula_persona         = $request->cedula;
            $estudiante->estatus                 = $request->estatus;
            $val = $estudiante->save();


        }
        else
        {
            $estudiante = new Estudiante();

            $estudiante->carrera_estudiante     = $request->carrera_estudiante;
            $estudiante->semestre_estudiante    = $request->semestre_estudiante;
            $estudiante->id_proyecto            = $request->id_proyecto;
            $estudiante->cedula_persona         = $request->cedula;
            $estudiante->estatus                 = $request->estatus;
            $val = $estudiante->save();
        }

        return array('result'=>$val,'obj'=>$estudiante->id_estudiante,'keystone'=>'id_estudiante');
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
        $estudiante     = Estudiante::find($id);
        $persona        = Persona::buscarpersona($estudiante->cedula_persona)->get();
        $persona        = Persona::find($persona[0]->id_persona);

        $persona->cedula    = $request->cedula;
        $persona->nombre    = $request->nombre;
        $persona->apellido  = $request->apellido;
        $persona->email     = $request->email;
        $persona->telefono  = $request->telefono;
        $persona->estatus    = $request->estatus;
        $persona->save();


        $estudiante->carrera_estudiante     = $request->carrera_estudiante;
        $estudiante->semestre_estudiante    = $request->semestre_estudiante;
        $estudiante->id_proyecto            = $request->id_proyecto;
        $estudiante->cedula_persona         = $request->cedula;
        $estudiante->estatus                 = $request->estatus;
        $val = $estudiante->save();

        return array('result'=>$val,'obj'=>$estudiante->id_estudiante,'keystone'=>'id_estudiante');
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
        $persona = Persona::buscarpersona($estudiante->cedula_persona)->get();
        $persona = Persona::find($persona[0]->id_persona);

        $persona->estatus = false;
        $estudiante->estatus = false;

        $persona->save();
        $val = $estudiante->save();

        return array('result'=>$val,'obj'=>$estudiante->id_estudiante,'keystone'=>'id_estudiante');
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
