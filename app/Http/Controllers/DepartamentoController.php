<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;
use SISAUGES\Models\Departamento;
use SISAUGES\Models\Institucion;
use SISAUGES\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {

        $institucion=new Institucion();

        var_dump($institucion);

        $departamento = Departamento::institucionrelaciones($request)->orderBy('descripcion_departamento', 'desc')->paginate(20);

        var_dump($departamento);

        return view('departamento.index',compact('departamento'));

    }

    public function renderForm(Request $request){


        if ($request->typeform=='add') {
            $action="departamento/crear";
        }elseif($request->typeform=='modify'){
            $action="departamento/modificar/".$request->field_id;;
        }elseif ($request->typeform=='deleted') {
            $action="departamento/eliminar/".$request->field_id;
        }

        $departamento = Departamento::find($request->field_id);

        if ($request->typeform=='deleted') {
            $fields=false;
        }else{

            // $instituciones=Institucion::all()->toArray();

            $instituciones=DB::table('institucion')->select(array('id_institucion','nombre_institucion'))->get();

            $instituciones = json_decode(json_encode($instituciones), true);


            $arrayI = array();
            $arrayD = array();
            for ($i=0; $i < sizeof($instituciones) ; $i++) {
                array_push($arrayI,$instituciones[$i]["id_institucion"]);
                array_push($arrayD,$instituciones[$i]["nombre_institucion"]);
            }

            $res = array_combine($arrayI, $arrayD);

            $hiddenfields = array(
                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                )
            );

            $fields=array(

                'descripcion_departamento' => array(
                    'type'  => 'text',
                    'value' => (empty($departamento))? '' : $departamento->descripcion_departamento,
                    'id'    => 'descripcion_departamento',
                    'label' => 'Nombre '
                ),

                'id_institucion' => array(
                    'type'  => 'select',
                    'value' => (empty($departamento))? '' : $departamento->id_institucion,
                    'id'    => 'id_institucion',
                    'label' => 'Institucion',
                    'options'   => $res
                ),

                'status' => array(
                    'type'      => 'select',
                    'value'     => (empty($departamento))? '' : $departamento->status,
                    'id'        => 'status',
                    'validaciones'=>array(
                        'obligatorio'
                    ),
                    'label'     => 'Status',
                    'options'   => array(
                        ''=>'Seleccione...',
                        'true'=>'Activo',
                        'false'=>'Inactivo'
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
     * Metodo diseñado para direccionar a la pantalla de agregar un departamento
     *
     * Este metodo redirige a la pantalla agregar departamento
     * la cual mostrara un formulario con los campos necesarios para almacenar
     * en la base de datos
     *
     * @param void
     *
     * @return $departamento devuelve objeto de tipo departamento
     */
    public function store(Request $request){

        $departamento=new Departamento($request->all());

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
            $val=$departamento->save();

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

        $departamento=Departamento::find($id);


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

            $departamento->descripcion_departamento=$request->descripcion_departamento;
            $departamento->id_institucion=$request->id_institucion;
            $departamento->status=$request->status;

            $val=$departamento->save();
        }

        return $val;

    }




    /**
     * Metodo diseñado para eliminar los datos de un departamento en la base de datos
     *
     * @param $id codigo de asociación del departamento en la base de datos
     *
     * @return $menssage retorna el resultado de la operación.
     */


    public function destroy($id){
        $departamento=Departamento::find($id);
        $departamento->status='false';
        $val=$departamento->save();
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
