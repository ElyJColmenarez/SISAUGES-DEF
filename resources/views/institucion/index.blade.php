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

                    <div>

                        <div class="form-group col-md-3 modalscript">
                            <a class="btn btn-default click" href="#" data-typeform="add" data-taction="registerform" data-field-id="0">Agregar <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                
                                <div>
                                    {!!Form::open(['url'=>'institucion/listar' , 'method' => 'post' , 'class'=>'form-horizontal form-bordered formsimple'])!!}

                                        <div class="col-md-6 col-md-offset-6">
                                            <div class="input-group mb-md">

                                                <span class="input-group-addon advanced-search-proyect" data-show="0" data-formid="1">
                                                    Busqueda avanzada
                                                </span>
                                                <input type="text" name="nombre_institucion" class="form-control form1" value="@if(isset($request->nombre_institucion)){{ $request->nombre_institucion }}@endif">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default start-search-proyect" type="submit">Go!</button>
                                                </span>

                                            </div>
                                        </div>
                                        
                                    {!! Form::close() !!}

                                </div>

                            </div>
                        </div>


                    </div>


                    <div class="hiddenformsearch">
                        @include('layouts.searchform')
                    </div>

                    <div class="form-group col-md-12">
                        

                        <table class="table table-bordered table-striped mb-none" id="datatable-institucion" data-search-url="{{ url('institucion/buscar') }}">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-t-body modalscript">

                                @include('institucion.regulartable')

                            </tbody>

                        </table>

                        <div class="tblwait">
                            <div class="waitingback"></div>
                        </div>

                        <div class="row resultspaginate">
                            
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                {!!$instituciones->appends($request->all())->render()!!} 
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