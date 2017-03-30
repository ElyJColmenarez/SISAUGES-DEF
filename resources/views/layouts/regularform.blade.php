	<section class="panel">
									

		{!!Form::open(['url'=>$action, 'class'=>'form-horizontal form-bordered', 'method' => 'post', 'id'=>'modalmicroform'])!!}

	        <header class="panel-heading">
				<h2 class="panel-title">Formulario de Registro</h2>
			</header>

			<div class="waitingimg" style="display: none;">
		    	<div class="waitingback"></div>
		    	<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-default modal-dismiss">Cancelar</button>
						</div>
					</div>
				</footer>
		    </div>

		    <div class="imgpreview" style="display: none;">
		    	<div class="panel-body">
			    	<div class="waitingprev">
			    		<img src="{{asset('assets/images/!logged-user.jpg')}}">
			    	</div>
			    </div>
		    	<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary">Atras</button>
						</div>
					</div>
				</footer>
		    </div>

		    <div id="result-mdl" style="display: none;" data-tmodalorigin="{{(!$fields)?'modal-block-warning':'modal-block-primary'}}">
		    	<div class="panel-body ">
					<div class="modal-wrapper">
						<div class="modal-icon">
							<i class=""></i>
						</div>
						<div class="modal-text">
							<h4 class="msn-alerta-header"></h4>
							<p class="msn-alerta-body"></p>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button id="mld-dismiss-fin" class="">OK</button>
						</div>
					</div>
				</footer>
		    </div>

		    @if($fields)
			    <div id="mdl-truebody">
					<div class="panel-body">

					<?php $datos=array_chunk($fields, 2,true); ?>

						<div class="formcontent">

							@foreach( $datos as $key2 => $value2 )

								<div class="form-group">

							        @foreach( $value2 as $key => $value )

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

							        		<div class="col-md-6">
								                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
								                <div class="col-md-8">
								                    <input type="{!! $value['type'] !!}" class="form-control" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
								                </div>
								            </div>

								        @elseif( $value['type']=='textarea' )

								        	<div class="col-md-12">
								                <label class="col-md-2 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
								                <div class="col-md-10">
								                	<textarea class="form-control" rows="3"  id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif></textarea>
								                </div>
								            </div>

								        @elseif( $value['type']=='separador' )




								        @elseif( $value['type']=='muestra' )

								        	<div class="col-md-12 muestra-seccion">

								        		<div class="row">
								        			<div class="col-md-4">
									        			<button class="btn btn-default click" name="cargaimg">Agregar Archivos</button>
									        			<div class="ocultos"><input type="file" name="imagenes[]"  multiple="true"></div>
									        			<div class="borrados">
									        				<input type="hidden" name="borrados[]" value="">
									        			</div>
									        		</div>

								        		</div>

								        		<div class="row">
								        			<div class="col-md-12">
								        				<table class="table table-bordered table-striped mb-none">

								        					<thead>
								        						<tr>
								        							<th>Archivo</th>
								        							<th>Tipo de Archivo</th>
								        							<th>Tamaño</th>
								        							<th></th>
								        						</tr>
								        					</thead>
								        					<tbody>
								        						
								        					</tbody>

								        				</table>
								        			</div>
								        		</div>
								        		
								        	</div>



								        @elseif( $value['type']=='date' )


								        	<div class="col-md-6">
												<label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
												<div class="col-md-8">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker class="form-control datepkr" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}">
													</div>
												</div>
											</div>

							        	@elseif( $value['type']=='select' )

							        		@if(isset($value['extrafields']))

							        			<div class="col-md-6">
									                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
									                <div class="col-md-8" style="padding: 0px">
									                    
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

							        		@else


							        			<div class="col-md-6">
									                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
									                <div class="col-md-8">
									                    <select data-plugin-select name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
									                            
								                        	@foreach( $value['options'] as $key2 => $value2 )

								                        		<option value="{!! $key2 !!}" {{ ($value['value']==$key2)? 'selected' : '' }}> {!! $value2 !!} </option>

								                        	@endforeach

									                    </select>
									                </div>
									            </div>


							        		@endif

							        	@else


							        	@endif

							        @endforeach
							    
							    </div>


							@endforeach

							@foreach( $hiddenfields as $key => $value )
								<input type="{!! $value['type'] !!}" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}">
							@endforeach

						</div>

			        </div>

					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button class="btn btn-primary" name="finregistro">Finalizar Registro</button>
								<button class="btn btn-default modal-dismiss">Cancelar</button>
							</div>
						</div>
					</footer>

				</div>

			@else

				<div id="mdl-truebody">
					<div class="panel-body ">
						<div class="modal-wrapper">
							<div class="modal-icon">
								<i class="fa fa-warning"></i>
							</div>
							<div class="modal-text">
								<h4 >Alerta!</h4>
								<p>¿Esta seguro que desea eliminar este dato?</p>
							</div>
						</div>
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button class="btn btn-warning " name="finregistro">SI</button>
								<button class="btn btn-default modal-dismiss">NO</button>
							</div>
						</div>
					</footer>
				</div>

			@endif

	    {!! Form::close() !!}

    </section>

