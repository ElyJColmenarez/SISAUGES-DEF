<?php
/**
 * Copyright (c) 2016 Ely Colmenarez
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace SISAUGES\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;
use SISAUGES\Models\Departamento;
use SISAUGES\Models\Institucion;

use Illuminate\Support\Facades\View;
/**
 * Class UserController
 *
 * Esta clase se diseño para manejar las transancciones de la institución en la base de
 * datos, estas pueden ser agregar,
 * modificar, eliminar o listar.
 *
 * @author rafa
 * @copyright 2017 
 * @package SISAUGES\Http\Controllers
 */
class DepartamentoController extends Controller
{
    public function index(Request $request)
    {

 /*    var_dump($request->descripcion_departamento);
     var_dump($request->status);*/
      

        /* if (!is_null($request->status)){
      
             $departamento = Departamento::descripciondepartamento($request->descripcion_departamento)->    
                whereHas('Institucion', function($query) use ($request){
                        $query->nombreinstitucion($request->nombre_institucion);
                })-> 
                   statusdepartamento($request->status)->
                orderBy('descripcion_departamento', 'desc')->paginate(20);

        }else{
             $departamento = Departamento::descripciondepartamento($request->descripcion_departamento)->    
                whereHas('Institucion', function($query) use ($request){
                        $query->nombreinstitucion($request->nombre_institucion);
                })-> 
                //   statusdepartamento($request->status)->
                orderBy('descripcion_departamento', 'desc')->paginate(20);
        }*/

          $departamento = Departamento::DescripcionDepartamento($request->descripcion_departamento)->InstitucionRelaciones($request)
               //     StatusDepartamento($request->status)                   
                    ->orderBy('descripcion_departamento', 'desc')->paginate(20);

                    dd($departamento);
 

         $action="departamento/listar";

            $fields=array(

                'descripcion_departamento' => array(
                    'type'  => 'text',
                    'value' => (isset($request->descripcion_departamento))?  $request->descripcion_departamento:'',
                    'id'    => 'descripcion_departamento',
                    'label' => 'Nombre'
                ),
               

                 'nombre_institucion' => array(
                    'type'  => 'text',
                    'value' => (isset($request->nombre_institucion))?  $request->nombre_institucion:'',
                    'id'    => 'nombre_institucion',
                    'label' => 'institucion '
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
                        'true'=>'Activo',
                        'false'=>'Inactivo'
                    )
                )
            );


     

        $data=array(

            'title'=>'Departamento',
            'principal_search'=>'descripcion_departamento',
            'registros'=>$departamento,
            'carpeta'=>'departamento'

        );

          return view('layouts.index',compact('data','action','fields','request'));


    }

    public function renderForm(Request $request){


        if ($request->typeform=='add') {
            $action="departamento/crear";
        }elseif($request->typeform=='modify'){
            $action="departamento/editar/".$request->field_id;;
        }elseif ($request->typeform=='deleted') {
            $action="departamento/eliminar/".$request->field_id;
        }elseif($request->typeform=='search'){
            $action="departamento/buscar";
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
