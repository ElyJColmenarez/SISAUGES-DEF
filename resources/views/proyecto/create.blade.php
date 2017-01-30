@extends('layouts.app')
@section('title', 'Proyectos')
@section('content')

    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Agregar Proyecto</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="get">

                        <div class="form-group col-md-12">
                            <h3>Datos del Proyecto</h3>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDefault">Nombre del Proyecto</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="inputDefault">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">Estatus del Proyecto</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate">
                                    <option>Iniciado</option>
                                    <option>Pendiente</option>
                                    <option>En progreso</option>
                                    <option>Cancelado</option>
                                    <option>Culminado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">Permisos del Proyecto</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate">
                                    <option>Iniciado</option>
                                    <option>Pendiente</option>
                                    <option>En progreso</option>
                                    <option>Cancelado</option>
                                    <option>Culminado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">Sector Involucrado</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate">
                                    <option>Iniciado</option>
                                    <option>Pendiente</option>
                                    <option>En progreso</option>
                                    <option>Cancelado</option>
                                    <option>Culminado</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group col-md-12">
                            <h3>Datos de la Institución</h3>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">Instituciones Registradas</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate">
                                    <option>Iniciado</option>
                                    <option>Pendiente</option>
                                    <option>En progreso</option>
                                    <option>Cancelado</option>
                                    <option>Culminado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <a class="modal-with-form btn btn-default" href="#modalForm">Agregar</a>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <h3>Solicitantes</h3>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">Representante</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate">
                                    <option>Iniciado</option>
                                    <option>Pendiente</option>
                                    <option>En progreso</option>
                                    <option>Cancelado</option>
                                    <option>Culminado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <a class="modal-with-form btn btn-default" href="#modalForm">Agregar</a>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-12" ></div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label">Estudiante</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate">
                                    <option>Iniciado</option>
                                    <option>Pendiente</option>
                                    <option>En progreso</option>
                                    <option>Cancelado</option>
                                    <option>Culminado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <a class="modal-with-form btn btn-default" href="#modalForm">Agregar</a>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-md-4 control-label" for="inputDisabled">Disabled</label>
                            <div class="col-md-8">
                                <input class="form-control" id="inputDisabled" type="text" placeholder="Disabled input here..." disabled="">
                            </div>
                        </div>



                        <div class="form-group col-md-12">
                            <h3>Muestras</h3>
                        </div>

                        <div class="form-group col-md-3">
                            <button id="addToTable" class="btn btn-default" >Agregar Muestras <i class="fa fa-plus"></i></button>
                        </div>

                        <div class="form-group col-md-3">
                            <a class="modal-with-form btn btn-default" href="#modalForm">Registrar Tecnica de Estudio</a>
                        </div>

                        <div class="form-group col-md-12" id="principal_muestras_table">
                            
                            <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th class="img_tbl_hdr">Miniatura</th>
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
                                        <td class="actions">
                                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="form-group col-md-12 center">
                            <button class="btn btn-primary">Finalizar Registro</button>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>


    <!-- Modals -->

    <div id="modalForm" class="modal-block modal-block-primary mfp-hide">

    </div>

@endsection