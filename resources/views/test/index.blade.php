@extends('layouts.app')
@section('title', 'Proyectos')
@section('content')

    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Usuarios</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group col-md-3 modalscript">
                        <a class="btn btn-default click" href="#" data-typeform="add" data-taction="test/registerform">Agregar Usuario</a>
                    </div>

                    <div class="form-group col-md-12" id="principal_muestras_table">
                        
                        <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                            <thead>
                                <tr>
                                    <th>Miniatura</th>
                                    <th>Codigo</th>
                                    <th>Archivo</th>
                                    <th>Descripción</th>
                                    <th>Tecnica de Estudio</th>
                                    <th>Operaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td>img</td>
                                    <td>ms-0001-iutfrp</td>
                                    <td>kjx9872.TIF</td>
                                    <td>Muestra Tomada de la quilla de un buque de carga.</td>
                                    <td>XYZ</td>
                                    <td class="actions modalscript">
                                        <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                        <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                        <a href="#" class="on-default click"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>

                <!--HiddenForm-->

                {!!Form::open(['url'=>'#', 'class'=>'hiddenform' , 'method' => 'post' , 'id'=>'principalform'])!!}

                    <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim btn btn-default openmodalbtn" href="#modalForm"></a>
                    <input type="hidden" name="typeform" value="">

                {!! Form::close() !!}

                <!-- Modals -->
                <div id="modalForm" class="zoom-anim-dialog modal-block-lg modal-block-primary mfp-hide">
                </div>
            </section>
        </div>
    </div>

@endsection