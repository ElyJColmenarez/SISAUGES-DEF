<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;

use SISAUGES\Http\Controllers\InstitucionController;

use SISAUGES\Models\Institucion;
use SISAUGES\Models\Departamento;
use SISAUGES\Models\Tutor;
use SISAUGES\Models\Estudiante;
use SISAUGES\Models\Muestra;
use SISAUGES\Models\Proyecto;
use SISAUGES\Models\Archivo;
use Storage;
use Validator;
use File;
use Imagick;

use Illuminate\Support\Facades\View;

class ProyectoController extends Controller
{



    public function fieldsRegisterCall($proyecto,$instituciones=null,$departamentos=null,$tutores=null,$estudiantes=null,$muestras=null){

            
        $fields=array(

            'titulo1'=>array(
                'type'      => 'titulo',
                'value'     => 'Datos de la Institución'
            ),

            'institucion'=>array(

                'type'      => 'relacion',
                'value'     => (isset($instituciones[1]))? $instituciones[1]->id_institucion:'',
                'id'        => 'id_institucion',
                'label'     => 'Institución',
                'selecttype'=> 'obj',
                'values_seting'=> $instituciones[2],
                'objkeys'   => array('id_institucion','nombre_institucion'),
                'options'   => $instituciones[0],
                'selectadd' => array(
                    'btnadd'=>'Agregar Institución',
                    'btnlabel'=>'Registrar Institución',
                    'btnfinlavel'=>'Registrar Institución',
                    'url'=> url('institucion/registerform')
                ),
                'relation_table'=>array(
                    'title'=>'Instituciones Asociadas al Proyecto',
                    'table_fields'=>array(
                        'Nombre de la Institucion'
                    ),
                    'table_key'=>'nombre_institucion',
                    'table_obj'=>(isset($proyecto->institucion))? $proyecto->institucion()->get() :null,
                ),
                'relacion_campo'=>'id_institucion'

            ),
            'separador1'=>array('type'=>'separador'),
            /*'departamento'=>array(

                'type'      => 'select',
                'value'     => (isset($departamentos[1]))? $departamentos[1]->id_departamento:'',
                'id'        => 'id_departamento',
                'label'     => 'Departamento',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_departamento','descripcion_departamento'),
                'options'   => $departamentos[0],
                'selectadd' => array(
                    'btnlabel'=>'Agregar Departamento',
                    'btnfinlavel'=>'Registrar Departamento',
                    'url'=> url('departamento/registerform')
                )

            ),
            'separador2'=>array('type'=>'separador'),

            'tutor'=>array(

                'type'      => 'select',
                'value'     => (isset($tutores[1]))? $tutores[1]->id_tutor:'',
                'id'        => 'id_tutor',
                'label'     => 'Tutor',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_tutor','cedula_persona'),
                'options'   => $tutores[0],
                'selectadd' => array(
                    'btnlabel'=>'Agregar Tutor',
                    'btnfinlavel'=>'Registrar tutor',
                    'url'=> url('tutor/registerform')
                )

            ),
            'separador3'=>array('type'=>'separador'),*/

            /*'titulo2'=>array(
                'type'      => 'titulo',
                'value'     => 'Datos del Estudiante'
            ),

            'estudiante'=>array(

                'type'      => 'relacion',
                'value'     => (isset($estudiantes[1]))? $estudiantes[1]->id_estudiante:'',
                'id'        => 'id_estudiante',
                'label'     => 'Estudiante',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_estudiantes','cedula_persona'),
                'options'   => $estudiantes[0],
                'values_seting'=> $estudiantes[2],
                'selectadd' => array(
                    'btnadd'=>'Agregar Estudiante',
                    'btnlabel'=>'Registrar Estudiante',
                    'btnfinlavel'=>'Registrar Estudiante',
                    'url'=> url('estudiante/registerform')
                ),
                'relation_table'=>array(
                    'title'=>'Estudiantes involucrados en el Proyecto',
                    'table_fields'=>array(
                        'Cedula del Estudiante'
                    ),
                    'table_key'=>'cedula_persona',
                    'table_obj'=>(isset($proyecto->estudiante))? $proyecto->estudiante()->get() :null,
                ),
                'relacion_campo'=>'id_estudiante'

            ),
            'separador4'=>array('type'=>'separador'),*/

            'titulo3'=>array(
                'type'      => 'titulo',
                'value'     => 'Datos del Proyecto'
            ),

            'nombre_proyecto' => array(
                'type'  => 'text',
                'value' => (isset($proyecto->nombre_proyecto))? $proyecto->nombre_proyecto:'',
                'id'    => 'nombre_proyecto',
                'label' => 'Nombre del Proyecto'
            ),
            'estatus_proyecto' => array(
                'type'  => 'select',
                'value' => (isset($proyecto->estatus_proyecto))? $proyecto->estatus_proyecto:'',
                'id'    => 'estatus_proyecto',
                'label' => 'Estatus del Proyecto',
                'options'   => array(
                    ''=>'Seleccione...',
                    'No iniciado'=>'No iniciado',
                    'En progreso'=>'En progreso',
                    'Culminado'=>'Culminado'
                )
            ),
            'fecha_inicio' => array(
                'type'  => 'date',
                'value' => (isset($proyecto->fecha_inicio))? $proyecto->fecha_inicio:'',
                'id'    => 'fecha_inicio',
                'label' => 'Fecha de Recepción del proyecto'
            ),
            'fecha_final' => array(
                'type'  => 'date',
                'value' => (isset($proyecto->fecha_final))? $proyecto->fecha_final:'',
                'id'    => 'fecha_final',
                'label' => 'Fecha de Finalización del proyecto'
            ),
            'permiso_proyecto' => array(
                'type'      => 'select',
                'value'     => (isset($proyecto->permiso_proyecto))? $proyecto->permiso_proyecto:'',
                'id'        => 'permiso_proyecto',
                'label'     => 'Permiso',
                'options'   => array(
                    ''=>'Seleccione...',
                    'Publico'=>'Publico',
                    'Privado'=>'Privado'
                )
            )
        );


        if ($muestras!=null) {

            $fields['titulo4']=array(
                'type'      => 'titulo',
                'value'     => 'Muestras Asociadas'
            );

            $fields['muestras']=array(

                'type'      => 'relacion',
                'value'     => '',
                'id'        => 'id_muestra',
                'label'     => 'Muestras',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_muestra','codigo_muestra'),
                'options'   => $muestras,
                'selectadd' => array(
                    'btnadd'=>'Agregar Muestras',
                    'btnlabel'=>'Registrar Muestras',
                    'btnfinlavel'=>'Registrar Muestras',
                    'url'=> url('muestra/registerform')
                ),
                'relation_table'=>array(
                    'title'=>'Muestras Asociadas al Proyecto',
                    'table_fields'=>array(
                        'Codigo de la Muestra'
                    ),
                    'table_key'=>'codigo_muestra',
                    'table_obj'=>(isset( $proyecto->muestras ))? $proyecto->muestras()->get() :null,
                ),
                'relacion_campo'=>'id_muestra'

            );

        }
        

        return $fields;

    }

    public function fieldsSearchCall(){
        $fields=array(

            
        );

        return $fields;
    }


    public function fieldsReportCall($institucion,$departamento,$estudiantes,$tutores,$muestras){



    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $proyectos=Proyecto::orderBy('id_proyecto', 'desc')->paginate(20);

        $action="proyecto/listar";

        $fields=$this->fieldsSearchCall();

        $data=array(

            'title'=>'Proyecto',
            'principal_search'=>'nombre_proyecto',
            'registros'=>$proyectos,
            'carpeta'=>'proyecto'

        );

        return view('layouts.index',compact('data','action','fields','request'));
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function renderForm(Request $request){

        
        if ($request->typeform=='add') {
            $action="proyecto/crear";
        }elseif($request->typeform=='modify'){
            $action="proyecto/editar/".$request->field_id;
        }elseif($request->typeform=='deleted'){
            $action="proyecto/eliminar/".$request->field_id;
        }


        /*if (isset($request->nextproyectstep)) {
            $step=$request->nextproyectstep+1;
        }else{
            $step=1;
        }*/


        $proyecto = Proyecto::find($request->field_id);

        if ($request->typeform=='deleted') {
            $fields=false;
            $modulo='Proyecto';
            $hiddenfields=false;
        }else{

            $hiddenfields=array(

                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
                'extra_url'=>array(
                    'type'  => 'hidden',
                    'value' =>  url('proyecto/registerform'),
                    'id'    => 'extra_url',
                ),

            );


            $ins=Institucion::find($request->institucion);
            $dep=Departamento::find($request->departamento);
            $tut=Tutor::find($request->tutor);
            $est=Estudiante::find($request->estudiante);


            $inses=Institucion::get();
            $depes=Departamento::get();
            $tutes=Tutor::get();
            $estes=Estudiante::get();
            $muestras=Muestra::get();

            if ($request->typeform=='modify') {
                $fields=$this->fieldsRegisterCall($proyecto,array($inses,$ins,$request),array($depes,$dep),array($tutes,$tut),array($estes,$est,$request),$muestras);
            }else{
                $fields=$this->fieldsRegisterCall($proyecto,array($inses,$ins,$request),array($depes,$dep),array($tutes,$tut),array($estes,$est,$request));
            }

            $modulo='Proyecto';
            
            
        }

        $htmlbody=View::make('layouts.regularform',compact('action','fields','hiddenfields','request','modulo'))->render();


        if ($htmlbody) {
            $retorno=array(
                'result'=>true,
                'html'  =>$htmlbody
            );
        }else{
            $retorno=array(
                'result'=>false,
            );
        }

        echo json_encode($retorno);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store($request){

        $proyecto=new Proyecto($request->all());

        $aux=$request->all();

        $validator=Validator::make($request->all(),[

            'nombre_proyecto'=>'required|min:1|max:255',
            'estatus_proyecto'=>'required|min:1|max:255',
            'fecha_inicio'=>'required|min:1|max:255',
            'fecha_final'=>'required|min:1|max:255',
            'permiso_proyecto'=>'required|min:1|max:255',
            'addeninid_institucion.*'=>'required'

        ]);


        if ($validator->passes()) {

            $val=$proyecto->save();


            foreach ($request->addeninid_institucion as $prokey => $provalue) {

                if (!$proyecto->institucion()->find($provalue)) {

                    $proyecto->institucion()->attach($provalue);

                    $proyecto->save();
                }

            }


            


        }else{
            $val=$validator->passes();
        }

        return array('result'=>$val,'obj'=>$proyecto->id_proyecto,'keystone'=>'id_proyecto');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($request, $id){

        $proyecto=Proyecto::find($id);

        $aux=$request->all();

        $validator=Validator::make($request->all(),[

            'nombre_proyecto'=>'required|min:1|max:255',
            'estatus_proyecto'=>'required|min:1|max:255',
            'fecha_inicio'=>'required|min:1|max:255',
            'fecha_final'=>'required|min:1|max:255',
            'permiso_proyecto'=>'required|min:1|max:255',
            'addeninid_institucion.*'=>'required'

        ]);


        if ($validator->passes()) {

            $val=$proyecto->save();

            if (isset($request->deleteinid_institucion)) {
                    
                foreach ($request->deleteinid_institucion as $prokey => $provalue) {

                    if ($muestra->proyecto()->find($provalue)) {

                        $muestra->proyecto()->detach($provalue);
                    }

                }
            }


            foreach ($request->addeninid_institucion as $prokey => $provalue) {

                if (!$proyecto->institucion()->find($provalue)) {

                    $proyecto->institucion()->attach($provalue);

                    $proyecto->save();
                }

            }


            


        }else{
            $val=$validator->passes();
        }

        return array('result'=>$val,'obj'=>$proyecto->id_proyecto,'keystone'=>'id_proyecto');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($request, $id){

        $proyecto=Proyecto::find($id);

        $proyecto->estatus_proyecto='Culminado';

        $val=$proyecto->save();

        return array('result'=>$val,'obj'=>$proyecto->id_proyecto,'keystone'=>'id_proyecto');

    }


    //Funciones Extra

    public function obtenerConteoProyectosxMes(){

        return Proyecto::whereMonth('fecha_inicio','=',date('n'))->whereYear('fecha_inicio','=',date('Y'))->count();

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

        $val=$this->destroy($request,$id);

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