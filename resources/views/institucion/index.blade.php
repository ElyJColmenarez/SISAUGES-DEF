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
                        <a class="btn btn-default click" href="#" data-typeform="add" data-taction="institucion/registerform" data-field-id="0">Agregar <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                    </div>

                    <div class="form-group col-md-12">
                        
                        {!!Form::open(['url'=>'institucion/buscar' , 'method' => 'post' , 'id'=>'tableform'])!!}

                            <table class="table table-bordered table-striped mb-none" id="datatable-institucion" data-search-url="{{ url('institucion/buscar') }}">
                                <thead>
                                    <tr class="form-group">
                                        <th class="tblhover" data-tbl-id="nombre">
                                            <div class="col-md-10" >
                                                <input type="text" class="form-control" name="nombre_institucion" placeholder="Nombre">
                                            </div> 
                                            <div class="col-md-2"><span class="fa fa-angle-down"></span></div>
                                        </th>
                                        <th class="tblhover" data-tbl-id="direccion">
                                            <div class="col-md-10 ">
                                                <input type="text" class="form-control" name="direccion_institucion" placeholder="Direccion">
                                            </div> 
                                            <div class="col-md-2"><span class="fa fa-angle-down"></span></div>
                                        </th>
                                        <th class="tblhover" data-tbl-id="telefono">
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="telefono_institucion" placeholder="Telefono">
                                            </div> 
                                            <div class="col-md-2"><span class="fa fa-angle-down"></span></div>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($instituciones as $institucion)

                                        <tr class="gradeX">
                                            <td>{{$institucion->nombre_institucion}}</td>
                                            <td>{{$institucion->direccion_institucion}}</td>
                                            <td>{{$institucion->telefono_institucion}}</td>
                                            <td class="actions modalscript">
                                                <a href="#" class="btn btn-warning click" data-typeform="modify" data-taction="institucion/registerform" data-field-id="{{$institucion->id_institucion}}"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger remove-row deleted-row" data-typeform="deleted" data-taction="institucion/registerform" data-field-id="{{$institucion->id_institucion}}"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        {!! Form::close() !!}

                        <div id="results" class="row">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                {!!$instituciones->render()!!} 
                            </div>
                        </div>

                    </div>


                </div>

                <!--HiddenForm-->

                {!!Form::open(['url'=>'#', 'class'=>'hiddenform' , 'method' => 'post' , 'id'=>'principalform'])!!}

                    <a class="mb-xs mt-xs mr-xs modal-with-zoom-anim btn btn-default openmodalbtn" href="#modalForm"></a>
                    <input type="hidden" name="typeform" value="">
                    <input type="hidden" name="field_id" value="">

                {!! Form::close() !!}

                <!-- Modals -->
                <div id="modalForm" class="zoom-anim-dialog modal-block-lg modal-block-primary mfp-hide">
                </div>
            </section>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{url('assets/js/principaltables/tabla_instituciones.js' )}}"></script>

@endpush