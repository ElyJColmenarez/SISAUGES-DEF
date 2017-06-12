<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;
use SISAUGES\Models\Institucion;
use SISAUGES\Models\Departamento;
use SISAUGES\Models\Muestra;
use SISAUGES\Models\TecnicaEstudio;
use SISAUGES\Models\TipoMuestra;
use SISAUGES\Models\Proyecto;
use SISAUGES\Models\Archivo;
use Storage;
use Validator;
use File;
use Imagick;

use Illuminate\Support\Facades\View;

class MuestraController extends Controller
{

     public function fieldsRegisterCall($muestra,$proyectos,$tecnicas,$tipos){

        $fields=array(

            'titulo1'=>array(
                'type'      => 'titulo',
                'value'     => 'Datos del Proyecto'
            ),

            'proyecto'  => array(
                'type'      => 'relacion',
                'value'     => (isset($muestra->proyecto->id_proyecto))? $muestra->proyecto->id_proyecto:'',
                'id'        => 'id_proyecto',
                'label'     => 'Proyecto',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_proyecto','nombre_proyecto'),
                'options'   => $proyectos,
                'selectadd' => array(
                    'btnadd'=>'Agregar Proyecto',
                    'btnlabel'=>'Registrar Proyecto',
                    'btnfinlavel'=>'Registrar Proyecto',
                    'url'=> url('proyecto/registerform')
                ),
                'relation_table'=>array(
                    'title'=>'Proyectos Asociados a la Muestra',
                    'table_fields'=>array(
                        'Nombre del Proyecto'
                    ),
                    'table_key'=>'nombre_proyecto',
                    'table_obj'=>(isset($muestra->proyecto))? $muestra->proyecto()->get() :null,

                ),
                'relacion_campo'=>'id_proyecto'
            ),

            'separador4'=>array('type'=>'separador'),

            'titulo3'=>array(
                'type'      => 'titulo',
                'value'     => 'Tipo de Muestra'
            ),

            /*'tecnica'  => array(
                'type'      => 'relacion',
                'value'     => (isset($muestra->tecnicaEstudio->id_tecnica_estudio))? $muestra->tecnicaEstudio->id_tecnica_estudio:'',
                'id'        => 'id_tecnica_estudio',
                'label'     => 'Técnica de estudio',
                'selecttype'=> 'obj',
                'objkeys'   => array('id_tecnica_estudio','descripcion_tecnica_estudio'),
                'options'   => $tecnicas,
                'selectadd' => array(
                    'btnadd'=>'Agregar técnica',
                    'btnlabel'=>'Registrar técnica',
                    'btnfinlavel'=>'Registrar técnica',
                    'url'=> url('tecnica-estudio/registerform')
                ),
                'relation_table'=>array(
                    'title'=>'Técnicas Asociados a la Muestra',
                    'table_fields'=>array(
                        'Nombre de la técnica'
                    ),
                    'table_key'=>'descripcion_tecnica_estudio',
                    'table_obj'=>(isset($muestra->tecnicaEstudio))? $muestra->tecnicaEstudio()->get() :null,

                ),
                'relacion_campo'=>'id_tecnica_estudio'
            ),*/


            'tipo_muestra'=>array(

                'type'      => 'select',
                'value'     => (!empty($muestra->id_tipo_muestra))? $estudiante->id_tipo_muestra:'',
                'id'        => 'id_tipo_muestra',
                'label'     => 'Tipo de Muestra',
                'selecttype'=> 'selectadd',
                'values_seting'=> $tipos,
                'objkeys'   => array('id_tipo_muestra','descripcion_tipo_muestra'),
                'options'   => $tipos,
                'selectadd' => array(
                    'btnadd'=>'Registrar Tipo de Muestra',
                    'btnlabel'=>'Registrar Tipo de Muestra',
                    'btnfinlavel'=>'Registrar Tipo de Muestra',
                    'url'=> url('tipo-muestra/registerform')
                ),
                'relation_table'=>array(
                    'title'=>'Tipos de Muestra',
                    'table_fields'=>array(
                        'Descripción del Tipo de Muestra'
                    ),
                    'table_key'=>'descripcion_tipo_muestra',
                    'table_obj'=>(isset($muestra->tipoMuestra))? $muestra->tipoMuestra->get() :null,
                ),
                'relacion_campo'=>'id_proyecto'

            ),

            'separador5'=>array('type'=>'separador'),

            'titulo2'=>array(
                'type'      => 'titulo',
                'value'     => 'Datos de la Muestra'
            ),

            'separador7'=>array('type'=>'separador'),

            'codigo_muestra' => array(
                'type'  => 'text',
                'value' => (isset($muestra->codigo_muestra))? $muestra->codigo_muestra:'',
                'id'    => 'codigo_muestra',
                'label' => 'Codigo de la Muestra'
            ),
            'separador1'=>array('type'=>'separador'),
            'descripcion_muestra' => array(
                'type'  => 'textarea',
                'value' => (isset($muestra->descripcion_muestra))? $muestra->descripcion_muestra:'',
                'id'    => 'descripcion_muestra',
                'label' => 'Descripcion de la Muestra'
            ),

            'separador01'=>array('type'=>'separador'),

            'fecha_recepcion' => array(
                'type'  => 'date',
                'value' => (isset($muestra->fecha_recepcion))? $muestra->fecha_recepcion:'',
                'id'    => 'fecha_recepcion',
                'label' => 'Fecha de Recepción de la Muestra'
            ),
            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($muestra->estatus))? $muestra->estatus:'',
                'id'        => 'estatus',
                'label'     => 'Estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
                    '0'=>'Inactivo'
                )
            ),
            'muestras'=>array(

                'type'      => 'muestra',
                'id'        => 'muestra',
                'label'     => 'Archivos',
                'data'      => $muestra

            )
        );


        return $fields;
     }

     public function fieldsSearchCall($request){

        $fields=array(

            'codigo_muestra' => array(
                'type'  => 'text',
                'value' => (isset($request->codigo_muestra))? $request->codigo_muestra:'',
                'id'    => 'codigo_muestra',
                'label' => 'Codigo de la Muestra'
            ),
            'tipo_muestra' => array(
                'type'  => 'select',
                'value' => (isset($request->tipo_muestra))? $request->tipo_muestra:'',
                'id'    => 'tipo_muestra',
                'label' => 'Tipo de Muestra',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Tipo1',
                    '2'=>'Tipo2'
                )
            ),
            'descripcion_muestra' => array(
                'type'  => 'text',
                'value' => (isset($request->descripcion_muestra))? $request->descripcion_muestra:'',
                'id'    => 'descripcion_muestra',
                'label' => 'Descripcion de la Muestra'
            ),
            'fecha_recepcion' => array(
                'type'  => 'date',
                'value' => (isset($request->fecha_recepcion))? $request->fecha_recepcion:'',
                'id'    => 'fecha_recepcion',
                'label' => 'Fecha de Recepción de la Muestra'
            ),
            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus:'',
                'id'        => 'estatus',
                'label'     => 'Estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
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

        $muestras=Muestra::codigomuestra($request->codigo_muestra)->tipomuestra($request->tipo_muestra)->descripcionmuestra($request->descripcion_muestra)->fecharecepcionmuestra($request->fecha_recepcion)->statusmuestra($request->estatus)->orderBy('codigo_muestra', 'desc')->paginate(20);

        $action="muestra/listar";

        $fields=$this->fieldsSearchCall($request);

        $data=array(

            'title'=>'Muestras',
            'principal_search'=>'codigo_muestra',
            'registros'=>$muestras,
            'carpeta'=>'muestra'

        );

        return view('layouts.index',compact('data','action','fields','request'));
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function generarImagenVisible($original_paht,$name,$extension){


        $ruta=base_path() ."/public/".$original_paht.'visibles/';

        if (!file_exists($ruta)) {
           File::makeDirectory($ruta,0777,true);
        }


        $image = new Imagick(base_path() ."/public/".$original_paht.$name);

        $name=str_replace($extension, 'jpg', $name);

        $ruta=$ruta.$name;

        $image->setImageFormat('jpg');

        $image->writeImage($ruta);

        return $name;

    }


    public function generarArchivo($file,$id,$proyecto){


        $ruta=base_path() ."/public/storage/".$proyecto."/";

        if (!file_exists($ruta)) {
           File::makeDirectory($ruta,0777,true);
        }


        $fecha=date("d_m_Y_H_i_s");

        $name=rand(0,9).$id.rand(0,9).'aux-'.$fecha.'.'.$file->getClientOriginalExtension();

        $file->move($ruta,$name);

        return $name;

    }

    public function renderForm(Request $request){

        
        if ($request->typeform=='add') {
            $action="muestra/crear";
        }elseif($request->typeform=='modify'){
            $action="muestra/editar/".$request->field_id;
        }elseif($request->typeform=='deleted'){
            $action="muestra/eliminar/".$request->field_id;
        }

        $muestra = Muestra::find($request->field_id);
        $proyectos = Proyecto::where('estatus_proyecto','<>','Culminado')->get();
        $tecnicas = TecnicaEstudio::where('estatus','=',1)->get();
        $tipos=TipoMuestra::where('estatus','=',1)->get();


        if ($request->typeform=='deleted') {
            $fields=false;

            $modulo='Muestra';

            $hiddenfields=array(

                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
                'extra_url'=>array(
                    'type'  => 'hidden',
                    'value' =>  url('muestra/registerform'),
                    'id'    => 'extra_url',
                )
            );


        }else{

            $hiddenfields=array(

                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
                'extra_url'=>array(
                    'type'  => 'hidden',
                    'value' =>  url('muestra/registerform'),
                    'id'    => 'extra_url',
                )
            );

            $fields=$this->fieldsRegisterCall($muestra,$proyectos,$tecnicas,$tipos);

            $modulo='Muestra';
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


    public function fileDelete($borrado){

            
        $file=Archivo::find($borrado);
        $varaux=base_path() .'/public/'.$file->ruta_img_muestra.$file->nombre_temporal_muestra;
        $visibles=base_path() ."/public/".$file->ruta_img_muestra.'visibles/'.$file->nombre_temporal_muestra;
        $aux=$file->delete();

        if ($aux) {

            if (file_exists($varaux)) {
                unlink($varaux);
            }

            if (file_exists($visibles)) {
                unlink($visibles);
            }

        }


    }


    public function dirDelete($carpeta=''){

        if (file_exists($carpeta)) {

           foreach(glob($carpeta . "/*") as $archivos_carpeta)
            {
                echo $archivos_carpeta;
         
                if (is_dir($archivos_carpeta))
                {
                    $this->tempDelete($archivos_carpeta);
                }
                else
                {
                    unlink($archivos_carpeta);
                }
            }
         
            rmdir($carpeta);

        }
    }


    public function imagenVal($request,$muestra){

        $retorno=array();

        //Agregar registros nuevos

        if (count($request->file('imagenes'))>1) {
            
            foreach ($request->file('imagenes') as $key => $value) {


                if(strpos($value->getClientMimeType(),'pdf')!==false || strpos($value->getClientMimeType(),'image')!==false){

                    $img=$this->generarArchivo($value,$muestra->id_muestra,$request->proyecto);

                    $file=new Archivo();

                    $file->ruta_img_muestra="storage/".$request->proyecto."/";
                    $file->fecha_analisis=date('d-m-Y');
                    $file->nombre_original_muestra=$request->imagenes[$key]->getClientOriginalName();
                    $file->nombre_temporal_muestra=$img;
                    $file->id_muestra=$muestra->id_muestra;
                    $file->save();

                    if (strpos($value->getClientMimeType(),'image')!==false) {
                        
                        $this->generarImagenVisible($file->ruta_img_muestra,$file->nombre_temporal_muestra,$value->getClientOriginalExtension());
                    }

                }else{
                    $retorno[]=$value;
                }

                 
            }

        }

        //Eliminar registros existentes

        $borrados=$request->borrados_existentes;

        if (isset($borrados)) {
            foreach ($borrados as $key => $value) {
            
                $this->fileDelete($value);

            }
        }

    }


    public function store($request){

        $muestra=new Muestra($request->all());

        $aux=$request->all();

        $validator=Validator::make($request->all(),[

            'codigo_muestra'=>'required|min:1|max:255',
            'tipo_muestra'=>'required|min:1|max:255',
            'descripcion_muestra'=>'required|min:1|max:255',
            'fecha_recepcion'=>'required|min:1|max:255',
            'estatus'=>'required|min:1|max:255',
            'addeninid_proyecto.*'=>'required'

        ]);

        //var_dump($validator->errors());

        if ($validator->passes()) {

            $val=$muestra->save();

            //Guardar proyectos.


            foreach ($request->addeninid_proyecto as $prokey => $provalue) {

                if (!$muestra->proyecto()->find($provalue)) {

                    $muestra->proyecto()->attach($provalue);

                    $muestra->save();
                }

            }


            foreach ($request->addeninid_tecnica_estudio as $prokey => $provalue) {

                if (!$muestra->tecnicaEstudio()->find($provalue)) {

                    $muestra->tecnicaEstudio()->attach($provalue);

                    $muestra->save();
                }

            }


            if ($val) {

                if ($request->file('imagenes')[0]!=null) {
                    $procesados=$this->imagenVal($request,$muestra);
                }

            }

        }else{
            $val=$validator->passes();
        }

        return array('result'=>$val,'obj'=>$muestra->id_muestra,'keystone'=>'id_muestra');

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
            'fecha_recepcion'=>'required|min:1|max:255',
            'estatus'=>'required|min:1|max:255',
            'addeninid_proyecto.*'=>'required'

        ]);

        if ($validator->passes() && isset($request->addeninid_proyecto)) {


            $muestra->codigo_muestra=$request->codigo_muestra;
            $muestra->tipo_muestra=$request->tipo_muestra;
            $muestra->descripcion_muestra=$request->descripcion_muestra;
            $muestra->fecha_recepcion=$request->fecha_recepcion;
            $muestra->estatus=$request->estatus;

            $val=$muestra->save();

            if ($val) {


                //Guardar proyectos.

                if (isset($request->deleteinid_proyecto)) {
                    
                    foreach ($request->deleteinid_proyecto as $prokey => $provalue) {

                        if ($muestra->proyecto()->find($provalue)) {

                            $muestra->proyecto()->detach($provalue);
                        }

                    }
                }


                if (isset($request->deleteinid_tecnica_estudio)) {
                    
                    foreach ($request->deleteinid_tecnica_estudio as $prokey => $provalue) {

                        if ($muestra->tecnicaEstudio()->find($provalue)) {

                            $muestra->tecnicaEstudio()->detach($provalue);
                        }

                    }
                }


                foreach ($request->addeninid_proyecto as $prokey => $provalue) {

                    if (!$muestra->proyecto()->find($provalue)) {

                        $muestra->proyecto()->attach($provalue);
                    }

                }



                foreach ($request->addeninid_tecnica_estudio as $prokey => $provalue) {

                if (!$muestra->tecnicaEstudio()->find($provalue)) {

                    $muestra->tecnicaEstudio()->attach($provalue);

                    $muestra->save();
                }

            }
   

                $procesados=$this->imagenVal($request,$muestra);
            }

        }else{
            $val=false;
        }

        return array('result'=>$val,'obj'=>$muestra->id_muestra,'keystone'=>'id_muestra');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($request, $id){

        $muestra=Muestra::find($id);

        foreach ($muestra->archivo()->get() as $key => $value) {
            
            $this->fileDelete($value->id_archivo);

        }

        $aux=$muestra->proyecto()->detach();


        $val=$muestra->delete();


        return array('result'=>$val,'obj'=>$muestra->id_muestra,'keystone'=>'id_muestra');

    }


    //Funciones Extra

    public function obtenerConteoMuestras(){

        return Muestra::count();

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