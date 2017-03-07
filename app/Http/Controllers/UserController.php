<?php

namespace SISAUGES\Http\Controllers;

use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use SISAUGES\Http\Requests;
use SISAUGES\Models\Persona;
use SISAUGES\Models\User;
use SISAUGES\Models\RolUsuario;

class UserController extends Controller
{
    protected $persona;
    protected $user;
    protected $rol;

    public function __construct()
    {
        //$this->middleware('');
        //$this->middleware('su');
        $this->persona = Persona::orderBy('cedula','desc')->paginate(20);
        $this->user = User::orderBy('cedula_persona','desc')->paginate(20);
        $this->rol = RolUsuario::all();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persona = $this->persona;
        $user = $this->user;

        return view('users.index',compact('persona','user'));

    }


    public function renderForm(Request $request)
    {
        if ($request->typeform == 'add')
        {
            $action = "usuario/crear/";
        }
        elseif($request->typeform == 'modify')
        {
            $action = "usuario/modificar/".$request->field_id;
        }
        elseif ($request->typeform == 'delete')
        {
            $action = "usuario/eliminar/".$request->field_id;
        }

        $persona = Persona::find($request->cedula);
        $usuario = User::find($request->cedula);

        if ($request->typeform == 'delete')
        {
            $fields = false;
        }
        else
        {
            $fields = array(

                'id_persona'     =>array(
                    'type'          => 'hidden',
                    'value'         => $request->id_persona,
                    'id'            => 'id_persona'
                ),
                'cedula'         => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : Crypt::decrypt($persona->cedula),
                    'id'            => 'cedula' ),

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
                        'obligatorio' )),

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
                    'value'         => (empty($usuario))? '' : $usuario->password,
                    'id'            => 'password',
                    'lavel'         => 'Contraseña',
                    'validaciones'  => array('obligatorio')
                ),

                'status'        => array(
                    'type'          => 'select',
                    'value'         => (empty($usuario))? '' : $usuario->status,
                    'id'            => 'status',
                    'validaciones'  => array(
                        'obligatorio'
                    ),
                    'label'         => 'Status',
                    'options'       => array(
                        'true'          => 'Activo',
                        'false'         => 'Inactivo'
                    )

                ),

                'id_rol'           => array(
                    'type'          => 'select',
                    'value'         => (empty($usuario))? '' : $usuario->id_rol,
                    'id'            => 'rol',
                    'validaciones'  => array('obligatorio'),
                    'label'         => 'Rol usuario',
                    'options'       => array('true' => 'Activo', 'false' => 'Inactivo')
                )
            );
        }

        $htmlBody = View::make('layouts.regularform',compact('action','fields'))->render();

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
            $persona = Persona::find($request->cedula);
            if (empty($persona))
            {
                $persona = new Persona();

                $persona->cedula    = Crypt::encrypt($request->cedula);
                $persona->nombre    = $request->nombre;
                $persona->apellido  = $request->apellido;
                $persona->email     = $request->email;
                $persona->telefono  = $request->telefono;
                $persona->status    = $request->status;
                $persona->save();

                $usuario = new User();

                $usuario->username          = $request->username;
                $usuario->password          = Hash::make($request->password);
                $usuario->id_rol            = $request->id_rol;
                $usuario->cedula_persona    = Crypt::encrypt($request->cedula);
                $usuario->save();


            }
            else
            {
                $usuario = new User();

                $usuario->username          = $request->username;
                $usuario->password          = Hash::make($request->password);
                $usuario->id_rol            = $request->id_rol;
                $usuario->cedula_persona    = Crypt::encrypt($request->cedula);
                $usuario->save();
            }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
