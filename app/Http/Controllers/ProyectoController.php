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



    public function fieldsRegisterCall($proyecto,$instituciones=null,$departamentos=null,$tutores=null,$estudiantes=null){

            
        $fields=array(

            'institucion'=>array(

                'type'      => 'select',
                'value'     => (isset($instituciones))? $instituciones->id_institucion:'',
                'id'        => 'id_institucion',
                'label'     => 'Institución',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_institucion','nombre_institucion'),
                'options'   => $instituciones,
                'selectadd' => array(
                    'btnlabel'=>'Agegar Institución',
                    'btnfinlavel'=>'Registrar Institución',
                    'url'=> url('institucion/registerform')
                )

            ),
            'separador1'=>array('type'=>'separador'),
            'departamento'=>array(

                'type'      => 'select',
                'value'     => (isset($departamentos))? $departamentos->id_departamento:'',
                'id'        => 'id_departamento',
                'label'     => 'Departamento',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_departamento','nombre_departamento'),
                'options'   => $departamentos,
                'selectadd' => array(
                    'btnlabel'=>'Agegar Departamento',
                    'btnfinlavel'=>'Registrar Departamento',
                    'url'=> url('departamento/registerform')
                )

            ),
            'separador2'=>array('type'=>'separador'),

            'tutor'=>array(

                'type'      => 'select',
                'value'     => (isset($tutores))? $tutores->id_tutor:'',
                'id'        => 'id_tutor',
                'label'     => 'Tutor',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_tutor','cedula_persona'),
                'options'   => $tutores,
                'selectadd' => array(
                    'btnlabel'=>'Agegar Tutor',
                    'btnfinlavel'=>'Registrar tutor',
                    'url'=> url('tutor/registerform')
                )

            ),
            'separador3'=>array('type'=>'separador'),
            'estudiante'=>array(

                'type'      => 'select',
                'value'     => (isset($estudiantes))? $estudiantes->id_estudiante:'',
                'id'        => 'id_estudiante',
                'label'     => 'Estudiante',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_estudiantes','cedula_persona'),
                'options'   => $estudiantes,
                'selectadd' => array(
                    'btnlabel'=>'Agegar Estudiante',
                    'btnfinlavel'=>'Registrar Estudiante',
                    'url'=> url('estudiante/registerform')
                )

            ),
            'separador4'=>array('type'=>'separador'),
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
                    '1'=>'Tipo1',
                    '2'=>'Tipo2'
                )
            ),
            'fecha_inicio' => array(
                'type'  => 'date',
                'value' => (isset($proyecto->fecha_inicio))? $proyecto->fecha_inicio:'',
                'id'    => 'fecha_inicio',
                'label' => 'Fecha de Recepción de la proyecto'
            ),
            'fecha_final' => array(
                'type'  => 'date',
                'value' => (isset($proyecto->fecha_final))? $proyecto->fecha_final:'',
                'id'    => 'fecha_final',
                'label' => 'Fecha de Recepción de la proyecto'
            ),
            'permiso_proyecto' => array(
                'type'      => 'select',
                'value'     => (isset($proyecto->permiso_proyecto))? $proyecto->permiso_proyecto:'',
                'id'        => 'permiso_proyecto',
                'label'     => 'Permiso',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
                    '0'=>'Inactivo'
                )
            )
        );

        return $fields;

    }

    public function fieldsSearchCall(){
        $fields=array(
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
        }else{

            $hiddenfields=array(

                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
                'form_step'=>array(
                    'type'  => 'hidden',
                    'value' => (isset($request->form_step))? ($request->form_step+1): 1 ,
                    'id'    => 'field_id',
                )

            );

            /*if ($request->typeform=='add') {

                //Pasos de registro de proyecto

                if ($step==1) {
                    $steptitle='Institución';

                    $inscontroller= new InstitucionController();

                    $fields=$inscontroller->fieldsRegisterCall(Institucion::find(0));
                }
                elseif ($step==2) {
                    $steptitle='';
                }
                elseif ($step==3) {
                    $steptitle='';
                }
                elseif ($step==4) {
                    $steptitle='';
                }
                elseif ($step==5) {
                    $steptitle='';
                }


                $modulo='Proyecto';
                $htmlbody=View::make('layouts.regularform',compact('action','fields','hiddenfields','request','modulo','steptitle','step'))->render();


            }else{

                $fields=$this->fieldsRegisterCall($proyecto);
                $modulo='Proyecto';
                $htmlbody=View::make('layouts.regularform',compact('action','fields','hiddenfields','request','modulo'))->render();
            }*/

            $fields=$this->fieldsRegisterCall($proyecto);
            $modulo='Proyecto';
            $htmlbody=View::make('layouts.regularform',compact('action','fields','hiddenfields','request','modulo'))->render();

            
        }

        

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

        $muestra=new Muestra($request->all());

        $aux=$request->all();

        $validator=Validator::make($request->all(),[

            'codigo_muestra'=>'required|min:1|max:255',
            'tipo_muestra'=>'required|min:1|max:255',
            'descripcion_muestra'=>'required|min:1|max:255',
            'fecha_inicio'=>'required|min:1|max:255',
            'estatus'=>'required|min:1|max:255',
            'proyecto'=>'required|min:1|max:255'

        ]);

        //var_dump($validator->errors());

        if ($validator->passes()) {

            $val=$muestra->save();

            if ($val) {

                if ($request->file('imagenes')[0]!=null) {
                    $procesados=$this->imagenVal($request,$muestra);
                }

            }

        }else{
            $val=$validator->passes();
        }

        return $val;

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($request, $id){

        $muestra=Muestra::find($id);

        $validator=Validator::make($request->all(),[

            'codigo_muestra'=>'required|min:1|max:255',
            'tipo_muestra'=>'required|min:1|max:255',
            'descripcion_muestra'=>'required|min:1|max:255',
            'fecha_inicio'=>'required|min:1|max:255',
            'estatus'=>'required|min:1|max:255',
            'proyecto'=>'required|min:1|max:255'

        ]);


        if ($validator->passes()) {


            $muestra->codigo_muestra=$request->codigo_muestra;
            $muestra->tipo_muestra=$request->tipo_muestra;
            $muestra->descripcion_muestra=$request->descripcion_muestra;
            $muestra->fecha_inicio=$request->fecha_inicio;
            $muestra->estatus=$request->estatus;

            $val=$muestra->save();

            if ($val) {
                $procesados=$this->imagenVal($request,$muestra);
            }

        }else{
            $val=$validator->passes();
        }

        return $val;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($request, $id){

        $institucion=Muestra::find($id);

        foreach ($institucion->archivo()->get() as $key => $value) {
            
            $this->fileDelete($value->id_archivo);

        }

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
            $retorno['mensaje']='Los datos no suministrados no son validos';

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
            $retorno['mensaje']='Los datos no suministrados no son validos';

        }

        echo json_encode($retorno);

    }

    public function ajaxRegularDestroy(Request $request,$id){

        $val=$this->destroy($request,$id);

        $retorno=array();

        if ($val) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='El registro de los datos fue exitoso...';

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos no suministrados no son validos.';

        }

        echo json_encode($retorno);

    }


}