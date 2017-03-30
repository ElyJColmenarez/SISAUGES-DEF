<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\Laboratorio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use SISAUGES\Http\Requests;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        
//$Laboratorio=Laboratorio::find(1);
   // if (!is_null($request->status)){
         $Laboratorio=Laboratorio::nombrelaboratorio($request->nombre_Laboratorio)->
         ubicacionlaboratorio($request->ubicacion_laboratorio)->
         telefonolaboratorio($request->telefono_laboratorio)->
      //   statuslaboratorio($request->status)->
            orderBy('nombre_laboratorio', 'desc')->paginate(20);
   /* }else{
        $Laboratorio=Laboratorio::nombrelaboratorio($request->nombre_Laboratorio)->
         ubicacionlaboratorio($request->ubicacion_laboratorio)->
         telefonolaboratorio($request->telefono_laboratorio)->    
         statuslaboratorio($request->status)->      
         orderBy('nombre_laboratorio', 'desc')->paginate(20);
    }*/
     
    //    dd($Laboratorio);

        $action="laboratorio/listar";

        $fields=array(

            'nombre_Laboratorio' => array(
                'type'  => 'text',
                'value' => (isset($request->nombre_Laboratorio))? $request->nombre_Laboratorio: '',
                'id'    => 'nombre_Laboratorio',
                'label' => 'Nombre del laboratorio'
            ),
            'ubicacion_laboratorio' => array(
                'type'  => 'text',
                'value' => (isset($request->ubicacion_laboratorio))? $request->ubicacion_laboratorio: '',
                'id'    => 'ubicacion_laboratorio',
                'label' => 'Ubicacion de laboratorio'
            ),
           
            'telefono_laboratorio' => array(
                'type'  => 'text',
                'value' => (isset($request->telefono_laboratorio))? $request->telefono_laboratorio: '',
                'id'    => 'telefono_laboratorio',
                'label' => 'Telefono de la laboratorio'
            ),
            'status' => array(
                'type'      => 'select',
                'value'     => (isset($request->status))? $request->status:'',
                'id'        => 'status',
                'label'     => 'Status',
                'options'   => array(
                    ''=>'Seleccione...',
                    'true'=>'Activo',
                    'false'=>'Inactivo'
                )
            )
        );

        $data=array(

            'title'=>'Laboratorio',
            'principal_search'=>'nombre_Laboratorio',
            'registros'=>$Laboratorio,
            'carpeta'=>'laboratorio'

        );


          AuditoriaController::store('Laboratorio','Consulta','Consulta de desSSS','usuario'); 


          
          return view('layouts.index',compact('data','action','fields','request'));       

    }

    public function renderform(Request $request){


        if ($request->typeform=='add') {
            $action="laboratorio/crear";
        }elseif($request->typeform=='modify'){
            $action="laboratorio/editar/".$request->field_id;;
        }elseif ($request->typeform=='deleted') {
            $action="laboratorio/eliminar/".$request->field_id;
        }

        $laboratorio = Laboratorio::find($request->field_id);

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

            'nombre_laboratorio' => array(
                'type'  => 'text',               
                'value'     => (empty($laboratorio))? '' : $laboratorio->nombre_laboratorio,
                'id'    => 'nombre_laboratorio',
                'label' => 'Nombre del laboratorio'
            ),
            'ubicacion_laboratorio' => array(
                'type'  => 'text',               
                'value'     => (empty($laboratorio))? '' : $laboratorio->ubicacion_laboratorio,
                'id'    => 'ubicacion_laboratorio',
                'label' => 'Ubicacion de laboratorio'
            ),
           
            'telefono_laboratorio' => array(
                'type'  => 'text',                
                'value'     => (empty($laboratorio))? '' : $laboratorio->telefono_laboratorio,
                'id'    => 'telefono_laboratorio',
                'label' => 'Telefono de la laboratorio'
            ),
            'status' => array(
                'type'      => 'select',               
                'value'     => (empty($laboratorio))? '' : $laboratorio->status,
                'id'        => 'status',
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

        $Laboratorio=new Laboratorio($request->all());

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
            $val=$Laboratorio->save();

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

        $Laboratorio=Laboratorio::find($id);

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

            $Laboratorio->nombre_laboratorio           =$request->nombre_laboratorio;
            $Laboratorio->ubicacion_laboratorio        =$request->ubicacion_laboratorio;
            $Laboratorio->telefono_laboratorio         =$request->telefono_laboratorio;            
            $Laboratorio->status                       =$request->status;

            $val=$Laboratorio->save();
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
        $Laboratorio=Laboratorio::find($id);
        $Laboratorio->status='false';
        $val=$Laboratorio->save();
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
