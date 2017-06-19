<?php

namespace SISAUGES\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use SISAUGES\Http\Requests;
use SISAUGES\Http\Controllers\Controller;

use SISAUGES\Models\Auditoria;
use SISAUGES\Models\User;

use Illuminate\Support\Facades\View;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $auditoria=Auditoria::eventoAuditoria($request->evento)
                                                    ->join('usuario','usuario.id_usuario','=','audits.user_id')
                                                    ->select('audits.*','usuario.username')
                                                    ->moduloAuditoria($request->modulo)
                                                    ->oldValuesAuditoria($request->oldValues)
                                                    ->newValuesAuditoria($request->newValues)
                                                    ->orderBy('id','asc')->paginate(20);


        $action="auditoria/listar";

        $fields=array(

            'evento' => array(
                'type'  => 'text',
                'value' => (isset($request->evento))? $request->evento:'',
                'id'    => 'evento',
                'label' => 'Evento de la auditoria'
            ),
            'modulo' => array(
                'type'  => 'text',
                'value' => (isset($request->modulo))? $request->modulo:'',
                'id'    => 'modulo',
                'label' => 'Módulo'
            ),
            'oldvalues' => array(
                'type'  => 'text',
                'value' => (isset($request->oldValues))? $request->oldValues:'',
                'id'    => 'oldvalues',
                'label' => 'Antiguos Valores'
            ),
            'newvalues' => array(
                'type'  => 'text',
                'value' => (isset($request->newValues))? $request->newValues:'',
                'id'    => 'newValues',
                'label' => 'Nuevos Valores'
            ),

            'date' => array(
                'type'  => 'text',
                'value' => (isset($request->date))? $request->date:'',
                'id'    => 'date',
                'label' => 'date'
            )
        );

        $data=array(

            'title'=>'Auditoria',
            'principal_search'=>'evento',
            'registros'=>$auditoria,
            'carpeta'=>'auditoria'

        );

        return view('layouts.indexAut',compact('data','action','fields','request'));

    }


}
