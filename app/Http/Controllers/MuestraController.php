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

        $muestras=Muestra::codigomuestra($request->codigo_muestra)->tipomuestra($request->tipo_muestra)->descripcionmuestra($request->descripcion_muestra)->fecharecepcionmuestra($request->fecha_recepcion)->statusmuestra($request->status)->orderBy('nombre_institucion', 'desc')->paginate(20);

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
                'value' => (isset($request->fecha_recepcion))? $fecha_recepcion:'',
                'id'    => 'fecha_recepcion',
                'label' => 'Fecha de Recepción de la Muestra'
            ),
            'status' => array(
                'type'      => 'select',
                'value'     => (isset($request->status))? $request->status:'',
                'id'        => 'status',
                'label'     => 'Status',
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


        $ruta=public_path()."/storage/";

        /*if (file_exists($ruta)) {
           $ruta=public_path()."/storage/"; 
        }else{
            Storage::makeDirectory($ruta);
        }*/

        $image = new Imagick($original_paht);

        $fecha=date("d_m_Y_H_i_s");

        $ruta=$ruta.$id.'aux-'.$fecha.".jpg";

        $image->setImageFormat('jpg');

        $image->writeImage($ruta);

        return $id.'aux-'.$fecha.'.jpg';

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
                'status' => array(
                    'type'      => 'select',
                    'value'     => (isset($muestra->status))? $muestra->status:'',
                    'id'        => 'status',
                    'label'     => 'Status',
                    'options'   => array(
                        ''=>'Seleccione...',
                        '1'=>'Activo',
                        '2'=>'Inactivo'
                    )
                ),
                'proyecto'  => array(
                    'type'      => 'select',
                    'value'     => (isset($muestra->proyecto->id_proyecto))? $muestra->status:'',
                    'id'        => 'id_proyecto',
                    'label'     => 'Proyecto',
                    'selecttype'=> 'obj',
                    'objkeys'   => array('id_proyecto','nombre_proyecto'),
                    'options'   => $proyectos
                ),
                'muestras'=>array(

                    'type'      => 'muestra',
                    'id'        => 'muestra',
                    'label'     => 'Archivos',
                    'data'      => $muestra

                )
            );


        }

        $htmlbody=View::make('layouts.regularform',compact('action','fields','hiddenfields'))->render();

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

        if (trim($request->codigo_muestra)=='' || trim($request->tipo_muestra)=='' || trim($request->descripcion_muestra)=='' || trim($request->fecha_recepcion)=='' || trim($request->status)=='') {
            $val=false;
        }else{

            $muestra->save();

            $borrados=$request->borrados;

            foreach ($request->file('imagenes') as $key => $value) {
                
                $cont=0;

                if (count($borrados)>0) {
                    foreach ($borrados as $key2 => $value2) {
                        if ($value2==$key) {
                            unset($borrados[$key2]);
                            $cont=1;
                        }
                    }
                    array_values($borrados);
                }

                if ($cont==0) {

                    $img=$this->generarImagenVisible($request->imagenes[$key]->getRealPath(),$muestra->id_muestra,$request->proyecto);

                    $muestra->proyecto()->attach($request->proyecto);
                }
                
            }

            $val=true;


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

        $institucion=Institucion::find($id);


        $aux=$request->all();

        $cont=0;

        foreach ($aux as $key => $value) {
            
            $value=trim($value);

            if ($value=='' && $key!='_token') {
                $cont++;
            }
        }

        if ($cont>0) {
            $val=false;
        }else{

            $institucion->nombre_institucion    = $request->nombre_institucion;
            $institucion->direccion_institucion = $request->direccion_institucion;
            $institucion->correo_institucional  = $request->correo_institucional;
            $institucion->telefono_institucion  = $request->telefono_institucion;
            $institucion->status                = $request->status;

            $val=$institucion->save();
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

        $institucion=Institucion::find($id);

        $institucion->status = $request->status;
        $val = $institucion->save();

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