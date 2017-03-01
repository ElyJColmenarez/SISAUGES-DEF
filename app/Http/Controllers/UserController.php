<?php

namespace SISAUGES\Http\Controllers;

use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;

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
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $persona = Persona::orderBy('cedula','desc')->paginate(20);
        return view('users.index',compact('persona'));
    }


    public function renderForm(Request $request)
    {
        if ($request->typeform == 'add')
        {
            $action = "usuario/crear/";
        }
        elseif($request->typeform == 'modify')
        {
            $action = "usuario/modificar/".$request->cedula_usuario;
        }
        elseif ($request->typeform == 'delete')
        {
            $action = "usuario/eliminar/".$request->cedula_usuario;
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

                'cedula' => array(
                    'type'          => 'text',
                    'value'         => (empty($persona))? '' : $persona->cedula,
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
                    'value'         => (empty($persona))? '' : $persona->status,
                    'id'            => 'status',
                    'validaciones'  => array(
                        'obligatorio'
                    ),
                    'label'         => 'Status',
                    'options'       => array(
                        'true'      => 'Activo',
                        'false'     => 'Inactivo'
                    )

                )
            );
        }

        $htmlBody = view::make('layouts.regularform',compact('action','fields'))->render();

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
            if (!empty($persona))
            {

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
