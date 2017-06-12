<?php

namespace SISAUGES\Http\Controllers;

use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use SISAUGES\Http\Requests;
use SISAUGES\Models\Persona;
use SISAUGES\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    public function fieldsRegisterCall($persona,$usuario){

        $fields = array(


                'cedula'         => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->cedula,
                    'id'            => 'cedula',
                    'label'         => 'Cédula',
                    'validaciones'  => array('solonumeros','obligatorio')),

                'nombre'         => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->nombre,
                    'id'            => 'nombre',
                    'label'         => 'Nombre',
                    'validaciones'  => array(
                        'solocaracteres',
                        'obligatorio')),

                'apellido'       => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->apellido,
                    'id'            => 'apellido',
                    'label'         => 'Apellido',
                    'validaciones'  => array(
                        'solocaracteres',
                        'obligatorio' )),

                'email'          => array(
                    'type'          => 'email',
                    'value'         => (empty($persona))? '' : $persona->email,
                    'id'            => 'email',
                    'label'         => 'Correo Electronico',
                    'validaciones'  => array(
                        'solocorreo',
                        'obligatorio' )), //no lo muestra

                'telefono'       => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->telefono,
                    'id'            => 'telefono',
                    'label'         => 'Teléfono',
                    'validaciones'  => array(
                        'solonumero',
                        'obligatorio' )),

                'username'      => array(
                    'type'          => 'text',
                    'value'         =>  (empty($usuario))? '' : $usuario->username,
                    'id'            => 'username',
                    'label'         => 'Nombre de Usuario',
                    'validaciones'  => array('solotexto','obligatorio')
                ),

                'password'      => array(
                    'type'          => 'password',
                    'value'         => '',
                    'id'            => 'password',
                    'label'         => 'Contraseña',
                    'validaciones'  => array('obligatorio')
                ),

                'id_rol'           => array(
                    'type'          => 'select',
                    'value'         => (empty($usuario))? '' : $usuario->id_rol,
                    'id'            => 'rol',
                    'validaciones'  => array('obligatorio'),
                    'label'         => 'Rol usuario',
                    'options'       => array('2' => 'Administrador', '3' => 'Operador')
                ),

                'estatus' => array(
                    'type'      => 'select',
                    'value'     => (empty($usuario))? '': $usuario->estatus,
                    'id'        => 'estatus',
                    'label'     => 'estatus',
                    'options'   => array(
                        ''=>'Seleccione...',
                        '1' =>'Activo',
                        '0'=>'Inactivo'
                    )
                )
            );

        return $fields;
    }

    public function fieldsSearchCall($request){

        $fields = array(


            'cedula'         => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->cedula,
                'id'            => 'cedula',
                'label'         => 'Cédula',
                'validaciones'  => array('solonumeros','obligatorio')),

            'nombre'         => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->nombre,
                'id'            => 'nombre',
                'label'         => 'Nombre',
                'validaciones'  => array(
                    'solocaracteres',
                    'obligatorio')),

            'apellido'       => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->apellido,
                'id'            => 'apellido',
                'label'         => 'Apellido',
                'validaciones'  => array(
                    'solocaracteres',
                    'obligatorio' )),

            'email'          => array(
                'type'          => 'email',
                'value'         => (empty($request))? '' : $request->email,
                'id'            => 'email',
                'label'         => 'Correo Electronico',
                'validaciones'  => array(
                    'solocorreo',
                    'obligatorio' )), //no lo muestra

            'telefono'       => array(
                'type'          => 'text',
                'value'         => (empty($request))? '' : $request->telefono,
                'id'            => 'telefono',
                'label'         => 'Teléfono',
                'validaciones'  => array(
                    'solonumero',
                    'obligatorio' )),

            'username'      => array(
                'type'          => 'text',
                'value'         =>  (empty($request))? '' : $request->username,
                'id'            => 'username',
                'label'         => 'Nombre de Usuario',
                'validaciones'  => array('solotexto','obligatorio')
            ),

            'id_rol'           => array(
                'type'          => 'select',
                'value'         => (empty($request))? '' : $request->id_rol,
                'id'            => 'rol',
                'validaciones'  => array('obligatorio'),
                'label'         => 'Rol usuario',
                'options'       => array('2' => 'Administrador', '3' => 'Operador')
            ),

            'estatus' => array(
                'type'      => 'select',
                'value'     => (isset($request->estatus))? $request->estatus:'',
                'id'        => 'estatus',
                'label'     => 'estatus',
                'options'   => array(
                    ''=>'Seleccione...',
                    '1' =>'Activo',
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
        $usuario = User::with('persona')->cedulaUser($request->cedula)->orderBy('cedula_persona','asc')->paginate(20);

        $action = "usuario/listar";

        $fields = $this->fieldsSearchCall($request);

        $data=array(

            'title'             => 'Usuarios',
            'principal_search'  => 'username',
            'registros'         => $usuario,
            'carpeta'           => 'users'

        );





        return view('layouts.index',compact('data','action','fields','request'));
    }


    public function renderForm(Request $request)
    {
        if ($request->typeform == 'add') {
            $action = "usuario/crear/";
        } elseif ($request->typeform == 'modify') {
            $action = "usuario/editar/" . $request->field_id;
        } elseif ($request->typeform == 'delete') {
            $action = "usuario/eliminar/" . $request->field_id;
        }

        $usuario = User::find($request->field_id);
        if (isset($usuario)){

            $persona = Persona::buscarpersona($usuario->cedula_persona)->get();
            $persona = Persona::find($persona[0]->id_persona);
        }else{

            $persona = Persona::find($request->field_id);

        }

        if ($request->typeform == 'delete')
        {
            $fields = false;
            $modulo='Usuario';
        }
        else
        {
            $hiddenfields = array(
                'field_id'=>array(
                    'type'  => 'hidden',
                    'value' => $request->field_id,
                    'id'    => 'field_id',
                )
            );

            $fields = $this->fieldsRegisterCall($persona,$usuario);

            $modulo='Usuario';
        }

        $htmlBody = View::make('layouts.regularform',compact('action','fields','hiddenfields','request','modulo'))->render();

        if ($htmlBody)
        {
            $retorno = array(
                'result'    => true,
                'html'      => $htmlBody
            );
        }
        else
        {
            $retorno = array('result'   => false);
        }

        echo json_encode($retorno);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('users.crear');
        }

        if ($request->isMethod('post'))
        {
            $persona = Persona::buscarpersona($request->cedula)->get();

            if (!isset($persona[0]))
            {
                $persona = new Persona();

                $persona->cedula    = $request->cedula;
                $persona->nombre    = $request->nombre;
                $persona->apellido  = $request->apellido;
                $persona->email     = $request->email;
                $persona->telefono  = $request->telefono;
                $persona->estatus    = $request->estatus;
                $persona->save();

                $usuario = new User();

                $usuario->username          = $request->username;
                $usuario->password          = Hash::make($request->password);
                $usuario->id_rol            = $request->id_rol;
                $usuario->cedula_persona    = $request->cedula;
                $usuario->estatus            = $request->estatus;
                $val = $usuario->save();


            }
            else
            {
                $usuario = new User();

                $usuario->username          = $request->username;
                $usuario->password          = Hash::make($request->password);
                $usuario->id_rol            = $request->id_rol;
                $usuario->cedula_persona    = $request->cedula;
                $usuario->estatus            = $request->estatus;
                $val = $usuario->save();
            }

            return array('result'=>$val,'obj'=>$usuario->id_usuario,'keystone'=>'id_usuario');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $persona = Persona::buscarpersona($usuario->cedula_persona)->get();
        $persona = Persona::find($persona[0]->id_persona);

        $persona->cedula    = $request->cedula;
        $persona->nombre    = $request->nombre;
        $persona->apellido  = $request->apellido;
        $persona->email     = $request->email;
        $persona->telefono  = $request->telefono;
        $persona->estatus    = $request->estatus;
        $persona->save();


        $usuario->username          = $request->username;
        $usuario->password          = Hash::make($request->password);
        $usuario->id_rol            = $request->id_rol;
        $usuario->cedula_persona    = $request->cedula;
        $usuario->estatus            = $request->estatus;

        $val = $usuario->save();


        return array('result'=>$val,'obj'=>$usuario->id_usuario,'keystone'=>'id_usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario=User::find($id);
        $persona = Persona::buscarpersona($usuario->cedula_persona)->get();
        $persona = Persona::find($persona[0]->id_persona);

        $usuario->estatus = false;
        $persona->estatus = false;
        $persona->save();
        $val = $usuario->save();

        return array('result'=>$val,'obj'=>$usuario->id_usuario,'keystone'=>'id_usuario');
    }


    //Funciones Extra

    public function obtenerConteoUsuarios(){

        return User::count();

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
