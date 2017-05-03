<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;
use SISAUGES\Models\Institucion;
use SISAUGES\Models\Departamento;
use SISAUGES\Models\Muestra;
use SISAUGES\Models\Proyecto;
use Storage;
use Validator;
use File;
use Imagick;

use Illuminate\Support\Facades\View;

class MuestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $muestras=Muestra::codigomuestra($request->codigo_muestra)->tipomuestra($request->tipo_muestra)->descripcionmuestra($request->descripcion_muestra)->fecharecepcionmuestra($request->fecha_recepcion)->orderBy('codigo_muestra', 'desc')->paginate(20);

        $action="institucion/listar";

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
                'label'     => 'estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
                    '2'=>'Inactivo'
                )
            )
        );

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


    public function generarImagenVisible($original_paht,$id,$proyecto){


        $ruta=base_path() ."/public/storage/test/";

        if (!file_exists($ruta)) {
           File::makeDirectory($ruta,0777,true);
        }


        $image = new Imagick($original_paht);

        $fecha=date("d_m_Y_H_i_s");

        $name=rand(0,9).$id.rand(0,9).'aux-'.$fecha.".jpg";

        $ruta=$ruta.$name;

        $image->setImageFormat('jpg');

        $image->writeImage($ruta);

        return $name;

    }


    public function generarArchivo($file,$id,$proyecto){


        $ruta=base_path() ."/public/storage/test/";

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
        $proyectos = Proyecto::where('status_proyecto','<>','Culminado')->get();

        if ($request->typeform=='deleted') {
            $fields=false;
        }else{

            $hiddenfields=array(

                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
            );

            $fields=array(

                'codigo_muestra' => array(
                    'type'  => 'text',
                    'value' => (isset($muestra->codigo_muestra))? $muestra->codigo_muestra:'',
                    'id'    => 'codigo_muestra',
                    'label' => 'Codigo de la Muestra'
                ),
                'tipo_muestra' => array(
                    'type'  => 'select',
                    'value' => (isset($muestra->tipo_muestra))? $muestra->tipo_muestra:'',
                    'id'    => 'tipo_muestra',
                    'label' => 'Tipo de Muestra',
                    'options'   => array(
                        ''=>'Seleccione...',
                        '1'=>'Tipo1',
                        '2'=>'Tipo2'
                    )
                ),
                'separador1'=>array('type'=>'separador'),
                'descripcion_muestra' => array(
                    'type'  => 'textarea',
                    'value' => (isset($muestra->descripcion_muestra))? $muestra->descripcion_muestra:'',
                    'id'    => 'descripcion_muestra',
                    'label' => 'Descripcion de la Muestra'
                ),
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
                    'label'     => 'estatus',
                    'options'   => array(
                        ''=>'Seleccione...',
                        '1'=>'Activo',
                        '0'=>'Inactivo'
                    )
                ),
                'proyecto'  => array(
                    'type'      => 'select',
                    'value'     => (isset($muestra->proyecto->id_proyecto))? $muestra->proyecto->id_proyecto:'',
                    'id'        => 'id_proyecto',
                    'label'     => 'Proyecto',
                    'selecttype'=> 'obj',
                    'objkeys'   => array('id_proyecto','nombre_proyecto'),
                    'options'   => $proyectos,
                    'selectadd' => array(
                        'btnlabel'=>'Agegar Proyecto',
                        'btnfinlavel'=>'Registrar Proyecto',
                        'url'=> url('proyecto/registerform')
                    )
                ),
                'muestras'=>array(

                    'type'      => 'muestra',
                    'id'        => 'muestra',
                    'label'     => 'Archivos',
                    'data'      => $muestra

                )
            );


        }

        $htmlbody=View::make('layouts.regularform',compact('action','fields','hiddenfields','request'))->render();

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

    public function imagenVal($request,$muestra){

        $retorno=array();

        //$borrados=$request->borrados;

        foreach ($request->file('imagenes') as $key => $value) {


            if (strpos($value->getClientMimeType(),'image')!==false) {

                $img=$this->generarImagenVisible($request->imagenes[$key]->getRealPath(),$muestra->id_muestra,$request->proyecto);

                $muestra->proyecto()->attach($request->proyecto,array('ruta_img_muestra'=>$img,'fecha_analisis'=>date('d-m-Y')));

            }elseif(strpos($value->getClientMimeType(),'pdf')!==false){

                $this->generarArchivo($value,$muestra->id_muestra,$request->proyecto);

            }else{
                $retorno=$value;
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
            'estatus'=>'required|min:1|max:255'

        ]);

        //var_dump($validator->errors());

        if ($validator->passes()) {

            $val=$muestra->save();

            if ($val) {
                $procesados=$this->imagenVal($request,$muestra);
            }

        }

        return $validator->passes();

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
            'estatus'=>'required|min:1|max:255'

        ]);

        //var_dump($validator->errors());

        if ($validator->passes()) {


            $muestra->codigo_muestra($request->codigo_muestra);
            $muestra->tipo_muestra($request->tipo_muestra);
            $muestra->descripcion_muestra($request->descripcion_muestra);
            $muestra->fecha_recepcion($request->fecha_recepcion);
            $muestra->estatus($request->estatus);

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