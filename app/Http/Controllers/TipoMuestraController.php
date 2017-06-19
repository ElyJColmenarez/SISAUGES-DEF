<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\TipoMuestra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use SISAUGES\Http\Requests;

class TipoMuestraController extends Controller
{

    public function fieldsRegisterCall($tipoMuestra){

        $fields=array(
               

            'descripcion_tipo_muestra' => array(
                'type'  => 'text',
                'value' => (empty($tipoMuestra))? '' : $tipoMuestra->descripcion_tipo_muestra,
                'id'    => 'descripcion_tipo_muestra',
                'label' => 'Nombre '
            ),
            'estatus' => array(
                'type'      => 'select',
                'value'     => (empty($tipoMuestra))? '' : $tipoMuestra->estatus,
                'id'        => 'estatus',
                'label'     => 'estatus',
                'validaciones'=>array(
                    'obligatorio'
                ),                    
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
                    '0'=>'Inactivo'
                )
            )
        );

        return $fields;
    }

    public function fieldsSearchCall($request){

        $fields=array(

            'descripcion_tipo_muestra' => array(
                'type'  => 'text',
                'value' => (isset($request->descripcion_tipo_muestra))?  $request->descripcion_tipo_muestra:'',
                'id'    => 'descripcion_departamento',
                'label' => 'Nombre'
            ),
           
            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus: '',
                'id'        => 'estatus',
                'label'     => 'estatus',
                'validaciones'=>array(
                    'obligatorio'
                ),                    
                'options'   => array(
                    ''=>'Seleccione...',
                    '1'=>'Activo',
                    '0'=>'Inactivo'
                )
            )
        ); 

        return $fields;
    }


    public function index(Request $request)
    {


        $tipos=TipoMuestra::descripciontipom($request->descripcion_tipo_muestra)->
        statustipom($request->estatus)->
        orderBy('descripcion_tipo_muestra', 'desc')->paginate(20);


         $action="tipo-muestra/listar";

        $fields=$this->fieldsSearchCall($request);    

        $data=array(

            'title'=>'Tipo de Muestra',
            'principal_search'=>'descripcion_tipo_muestra',
            'registros'=>$tipos,
            'carpeta'=>'tipomuestra'

        );

          return view('layouts.index',compact('data','action','fields','request'));       

    }

    public function renderform(Request $request){


        if ($request->typeform=='add') {
            $action="tipo-muestra/crear";
        }elseif($request->typeform=='modify'){
            $action="tipo-muestra/editar/".$request->field_id;;
        }elseif ($request->typeform=='deleted') {
            $action="tipo-muestra/eliminar/".$request->field_id;
        }

        $tipoMuestra = TipoMuestra::find($request->field_id);

        if ($request->typeform=='deleted') {
            $fields=false;
            $modulo='Tipo de Muestra';
        }else{


            $hiddenfields=array(

                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                ),
            );


            $fields=$this->fieldsRegisterCall($tipoMuestra);

            $modulo='Tecnica de Estudio';

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
     * Metodo diseñado para direccionar a la pantalla de agregar un tipoMuestra
     *
     * Este metodo redirige a la pantalla agregar tipoMuestra
     * la cual mostrara un formulario con los campos necesarios para almacenar
     * en la base de datos
     *
     * @param void
     *
     * @return $tipoMuestra devuelve objeto de tipo tipoMuestra
     */
    public function store(Request $request){

        $tipoMuestra=new TipoMuestra($request->all());

        $tipoMuestra->estatus=1;

        $aux=$request->all();

        $cont=0;

        foreach ($aux as $key => $value) {

            $value=trim($value);

            if ($value=='' &&  $key!='_token') {

                //   $cont++;
            }
        }

        if ($cont>0) {
            $val=false;
        }else{
            $val=$tipoMuestra->save();

        }

        return array('result'=>$val,'obj'=>$tipoMuestra->id_tipo_muestra,'keystone'=>'id_tipo_muestra');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($request, $id){

        $tipoMuestra=TipoMuestra::find($id);

        $tipoMuestra->estatus=1;

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

            $tipoMuestra->descripcion_tipo_muestra=$request->descripcion_tipo_muestra;
            $val=$tipoMuestra->save();
        }

        return array('result'=>$val,'obj'=>$tipoMuestra->id_tipo_muestra,'keystone'=>'id_tipo_muestra');

    }




    /**
     * Metodo diseñado para eliminar los datos de un tipoMuestra en la base de datos
     *
     * @param $id codigo de asociación del tipoMuestra en la base de datos
     *
     * @return $menssage retorna el resultado de la operación.
     */


    public function destroy($id){
        $tipoMuestra=TipoMuestra::find($id);
        $tipoMuestra->estatus='false';
        $val=$tipoMuestra->save();
        return array('result'=>$val,'obj'=>$tipoMuestra->id_tipo_muestra,'keystone'=>'id_tipo_muestra');
    }



    public function ajaxRegularStore(Request $request){

        $val=$this->store($request);

        $retorno=array();

        if ($val['result']) {
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

        if ($val['result']) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='Actualizacion de registro de los datos fue exitoso...';

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

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos suministrados no son validos.';

        }

        echo json_encode($retorno);

    }
}
