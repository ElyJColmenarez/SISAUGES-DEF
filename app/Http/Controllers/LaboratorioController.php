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


    public function fieldsRegisterCall($laboratorio){

        $fields=array(

            'nombre_laboratorio' => array(
                'type'  => 'text',               
                'value'     => (empty($laboratorio))? '' : $laboratorio->nombre_laboratorio,
                'id'    => 'nombre_laboratorio',
                'label' => 'Nombre del laboratorio',
                'validaciones'=>array(
                        'obligatorio'
                    ),
            ),
            'ubicacion_laboratorio' => array(
                'type'  => 'text',               
                'value'     => (empty($laboratorio))? '' : $laboratorio->ubicacion_laboratorio,
                'id'    => 'ubicacion_laboratorio',
                'label' => 'Ubicacion de laboratorio',
                'validaciones'=>array(
                        'obligatorio'
                    ),
            ),           
            'telefono_laboratorio' => array(
                'type'  => 'text',                
                'value'     => (empty($laboratorio))? '' : $laboratorio->telefono_laboratorio,
                'id'    => 'telefono_laboratorio',
                'label' => 'Telefono de la laboratorio',
                'validaciones'=>array(
                        'obligatorio'
                    )
            ),
            'estatus' => array(
                'type'      => 'select',
                'value'     => (empty($laboratorio))? '' : $laboratorio->estatus,
                'id'        => 'estatus',
                'label'     => 'estatus',
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
            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus:'',
                'id'        => 'estatus',
                'label'     => 'estatus',
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


        
        $Laboratorio=Laboratorio::nombrelaboratorio($request->nombre_Laboratorio)->
        ubicacionlaboratorio($request->ubicacion_laboratorio)->
        telefonolaboratorio($request->telefono_laboratorio)->
        statuslaboratorio($request->estatus)->
        orderBy('nombre_laboratorio', 'desc')->paginate(20);


        $action="laboratorio/listar";

        $fields=$this->fieldsSearchCall($request);

        $data=array(

            'title'=>'Laboratorio',
            'principal_search'=>'nombre_Laboratorio',
            'registros'=>$Laboratorio,
            'carpeta'=>'laboratorio'

        );

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
            $modulo='Laboratorio';
        }else{


        $hiddenfields=array(

            'field_id'=>array(
                'type'  => 'hidden',
                'value' => $request->field_id,
                'id'    => 'field_id',
            ),
        );


        $fields=$this->fieldsRegisterCall($laboratorio);

        $modulo='Laboratorio';

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

        $Laboratorio->estatus                       =1;

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

        return array('result'=>$val,'obj'=>$Laboratorio->id_laboratorio,'keystone'=>'id_laboratorio');

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
            $Laboratorio->estatus                       =1;

            $val=$Laboratorio->save();
        }

        return array('result'=>$val,'obj'=>$Laboratorio->id_laboratorio,'keystone'=>'id_laboratorio');

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
        $Laboratorio->estatus=false;
        $val=$Laboratorio->save();
        return array('result'=>$val,'obj'=>$Laboratorio->id_laboratorio,'keystone'=>'id_laboratorio');
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
