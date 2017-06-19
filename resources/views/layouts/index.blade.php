@extends('layouts.app')
@section('title', 'Proyectos')
@section('content')

    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">{{$data['title']}}</h2>
                </header>
                <div class="panel-body">

                    <div>

                        <div class="form-group col-md-3 modalscript">
                            @if(Auth::user()->id_rol != 4)
                                <a class="btn btn-default click" href="#" data-typeform="add" data-taction="registerform" data-field-id="0">Agregar <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                            @endif
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                
                                <div>



                                        {!!Form::open(['url'=>$action , 'method' => 'post' , 'class'=>'form-horizontal form-bordered formsimple'])!!}

                                            <div class="col-md-6 col-md-offset-6">
                                                <div class="input-group mb-md">

                                                    <span class="input-group-addon advanced-search-proyect" data-show="0" data-formid="1">
                                                        Busqueda avanzada
                                                    </span>

                                                    <?php $aux=$data['principal_search']; ?>
                                                    
                                                    <input type="text" name="{{$aux}}" class="form-control form1" value="@if(isset($request->$aux)){{ $request->$aux }}@endif">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default start-search-proyect" type="submit">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>
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
                        


                                @include($data['carpeta'].'.regulartable')


                        <div class="tblwait">
                            <div class="waitingback"></div>
                        </div>

                        <div class="row resultspaginate">
                            
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                {!!$data['registros']->appends($request->all())->render()!!}
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


                {!!Form::open(['url'=>'#', 'class'=>'hiddenform' , 'method' => 'post' , 'id'=>'principalmodalvalues'])!!}
                    

                {!! Form::close() !!}


                <!-- Modals -->
                <div id="modalForm" class="zoom-anim-dialog modal-block-lg modal-block-primary mfp-hide nextstepmodal">
                </div>

                <div id="modalsteps" data-laststep="0"></div>


            </section>
        </div>
    </div>

@endsection