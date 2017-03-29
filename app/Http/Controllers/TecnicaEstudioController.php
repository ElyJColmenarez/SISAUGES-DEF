<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\TecnicaEstudio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use SISAUGES\Http\Requests;

class TecnicaEstudioController extends Controller
{
    public function index(Request $request)
    {

        if (!is_null($request->status)){
            $tecnicas=TecnicaEstudio::DescripcionTecnicaE($request->descripcion_tecnica_estudio)->
            StatusTecnicaE($request->status)->
            orderBy('descripcion_tecnica_estudio', 'desc')->paginate(20);
        }else{
            $tecnicas=TecnicaEstudio::DescripcionTecnicaE($request->descripcion_tecnica_estudio)->
            orderBy('descripcion_tecnica_estudio', 'desc')->paginate(20);
        }

         $action="tecnica-estudio/listar";

            $fields=array(

                'descripcion_tecnica_estudio' => array(
                    'type'  => 'text',
                    'value' => (isset($request->descripcion_tecnica_estudio))?  $request->descripcion_tecnica_estudio:'',
                    'id'    => 'descripcion_departamento',
                    'label' => 'Nombre'
                ),
               
                'status' => array(
                    'type'      => 'select',
                    'value'     => (isset($request->status))? $request->status: '',
                    'id'        => 'status',
                    'label'     => 'Status',
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

        $data=array(

            'title'=>'Tecnicas de Estudio',
            'principal_search'=>'descripcion_tecnica_estudio',
            'registros'=>$tecnicas,
            'carpeta'=>'tecnicaestudio'

        );

          return view('layouts.index',compact('data','action','fields','request'));       

    }

    public function renderform(Request $request){


        if ($request->typeform=='add') {
            $action="tecnica-estudio/crear";
        }elseif($request->typeform=='modify'){
            $action="tecnica-estudio/editar/".$request->field_id;;
        }elseif ($request->typeform=='deleted') {
            $action="tecnica-estudio/eliminar/".$request->field_id;
        }

        $tecnicasEstudio = TecnicaEstudio::find($request->field_id);

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
               

                'descripcion_tecnica_estudio' => array(
                    'type'  => 'text',
                    'value' => (empty($tecnicasEstudio))? '' : $tecnicasEstudio->descripcion_tecnica_estudio,
                    'id'    => 'descripcion_tecnica_estudio',
                    'label' => 'Nombre '
                ),


                'status' => array(
                    'type'      => 'select',
                    'value'     => (empty($tecnicasEstudio))? '' : $tecnicasEstudio->status,
                    'id'        => 'status',
                    'validaciones'=>array(
                        'obligatorio'
                    ),
                    'label'     => 'Status',
                    'options'   => array(
                        ''=>'Seleccione...',
                        '1'=>'Activo',
                        '0'=>'Inactivo'
                    )
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
     * Metodo diseñado para direccionar a la pantalla de agregar un tecnicasEstudio
     *
     * Este metodo redirige a la pantalla agregar tecnicasEstudio
     * la cual mostrara un formulario con los campos necesarios para almacenar
     * en la base de datos
     *
     * @param void
     *
     * @return $tecnicasEstudio devuelve objeto de tipo tecnicasEstudio
     */
    public function store(Request $request){

        $tecnicasEstudio=new TecnicaEstudio($request->all());

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
            $val=$tecnicasEstudio->save();

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

        $tecnicasEstudio=TecnicaEstudio::find($id);


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

            $tecnicasEstudio->descripcion_tecnica_estudio=$request->descripcion_tecnica_estudio;
            $tecnicasEstudio->status=$request->status;

            $val=$tecnicasEstudio->save();
        }

        return $val;

    }




    /**
     * Metodo diseñado para eliminar los datos de un tecnicasEstudio en la base de datos
     *
     * @param $id codigo de asociación del tecnicasEstudio en la base de datos
     *
     * @return $menssage retorna el resultado de la operación.
     */


    public function destroy($id){
        $tecnicasEstudio=TecnicaEstudio::find($id);
        $tecnicasEstudio->status='false';
        $val=$tecnicasEstudio->save();
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
            $retorno['mensaje']='Actualizacion de registro de los datos fue exitoso...';

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos no suministrados no son validos';

        }

        echo json_encode($retorno);

    }

    public function ajaxRegularDestroy(Request $request,$id){

        $val=$this->destroy($id);

        $retorno=array();

        if ($val) {
            //Datos Validos
            $retorno['resultado']='success';
            $retorno['mensaje']='Desactivo fue exitoso...';

        }else{
            //Datos Invalidos
            $retorno['resultado']='danger';
            $retorno['mensaje']='Los datos no suministrados no son validos.';

        }

        echo json_encode($retorno);

    }
}
