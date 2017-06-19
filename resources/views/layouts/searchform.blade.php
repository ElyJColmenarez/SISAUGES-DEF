


{!!Form::open(['url'=>$action, 'class'=>'form-horizontal form-bordered searchform', 'method' => 'post'])!!}

    @if($fields)
	    <div class="col-md-12">

		    <div class="panel-group">

		    	<div class="panel panel-accordion panel-accordion-default">

		    		<div class="panel-body">

						<?php $datos=array_chunk($fields, 4,true); ?>

						<div class="formcontent">

							@foreach( $datos as $key2 => $value2 )

								<div class="form-group">			        
								@foreach( $value2 as $key => $value )

									@if(strpos($key, 'estatus')!==false && Auth::user()->id_rol == 4)

									
									@else

							        	@if(isset($value['validaciones']))
								                
						        			<?php $validaciones=""; ?>

					                    	@foreach($value['validaciones'] as $k => $val)

					                    		@if($k !== 'limites')
					                    			<?php $validaciones.= 'data-'.$val.'="true"'; ?> 
					                    		@else
					                    			<?php $validaciones.= 'data-limites="'.$val[0].','.$val[1].'"'; ?>
					                    		@endif

					                    	@endforeach

					                    @endif


							        	@if( $value['type']=='text' || $value['type']=='password' || $value['type']=='email')

							        		<div class="col-md-3">
								                <label class="control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>

								                <input type="{!! $value['type'] !!}" class="form-control" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
								            </div>

								        @elseif( $value['type']=='field' )


								        @elseif( $value['type']=='date' )


								        	<div class="col-md-3">
												<label class="control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
												
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span>
													<input type="text" data-plugin-datepicker class="form-control datepkr" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}">
												</div>
												
											</div>


								        @elseif( $value['type']=='hidden' )

								        	<input type="{!! $value['type'] !!}" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}">

							        	@elseif( $value['type']=='select' )

							        		@if(isset($value['extrafields']))

							        			<div class="col-md-3">
									                <label class="control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
									                <div class="col-md-12" style="padding: 0px">
									                    
									                    <div class="col-md-4">
									                        <select data-plugin-select name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
									                            
									                        	@foreach( $value['options'] as $key2 => $value2 )

									                        		<option value="{!! $key2 !!}" {{ ($value['value']==$key2)? 'selected' : '' }}> {!! $value2 !!} </option>

									                        	@endforeach

									                        </select>
									                    </div>
									                    @foreach( $value['extrafields'] as $key2 => $value2 )

									                    	@if(isset($value['extrafields']['validaciones']))
								                
											        			<?php $validaciones=""; ?>

										                    	@foreach($value['extrafields']['validaciones'] as $k => $val)

										                    		@if($k!='limites')
										                    			<?php $validaciones.= 'data-'.$val.'="true"'; ?> 
										                    		@else
										                    			<?php $validaciones.= 'data-limites="'.$val[0].','.$val[1].'"'; ?>
										                    		@endif

										                    	@endforeach

										                    @endif

										                    <div class="col-md-8">
										                        <input type="text" class="form-control" id="{!! $value2['name'] !!}" name="{!! $value2['name'] !!}" value="{!! $value2['value'] !!}" placeholder="{!! $value2['placeholder'] !!}" @if (isset($value['extrafields']['validaciones'])) {!! $validaciones !!}  @endif>
										                    </div>

										                @endforeach

									                </div>
									            </div>


									        @elseif(isset($value['selecttype']))


									        	<div class="col-md-3">
									                <label class="control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
								                    <select data-plugin-selectTwo name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>

								                    	<option value="">Seleccione...</option>
								                        
								                    	<?php $aux1=$value['objkeys'][0]; $aux2=$value['objkeys'][1] ?>

							                        	@foreach( $value['options'] as $key2 => $value2 )

							                        		<option value="{!! $value2->$aux1 !!}" {{ ($value['value']==$value2->$aux1)? 'selected' : '' }}> {!! $value2->$aux2 !!} </option>

							                        	@endforeach

								                    </select>
									            </div>


							        		@else


							        			<div class="col-md-3">
									                <label class="control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>

								                    <select data-plugin-select name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
								                            
							                        	@foreach( $value['options'] as $key2 => $value2 )

							                        		<option value="{!! $key2 !!}" {{ ($value['value']===$key2)? 'selected' : '' }}> {!! $value2 !!} </option>

							                        	@endforeach

								                    </select>

									            </div>


							        		@endif

							        	@else


							        	@endif

							        @endif

						        @endforeach
						    	</div>

						    @endforeach


				        </div>

				    </div>

			    </div>

		    </div>

		</div>

	@else

	@endif

{!! Form::close() !!}

