	<section class="panel">
									

		{!!Form::open(['url'=>$action, 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal form-bordered modalmicroform', 'method' => 'post'])!!}

	        <header class="panel-heading">
				<h2 class="panel-title">Formulario de {!! $modulo !!}</h2>
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

		    <div class="result-mdl" style="display: none;" data-tmodalorigin="{{(!$fields)?'modal-block-warning':'modal-block-primary'}}">
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
						<div class="col-md-12 text-right truebtndissmis">
							<button class="mld-dismiss-fin">OK</button>
						</div>
					</div>
				</footer>
		    </div>

		    @if($fields)
			    <div class="mdl-truebody">
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
								                	<textarea class="form-control" rows="3"  id="{!! $value['id'] !!}" name="{!! $key !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>{!! $value['value'] !!}</textarea>
								                </div>
								            </div>

								        @elseif( $value['type']=='separador' )




								        @elseif( $value['type']=='titulo' )

								        	<div class="col-md-12 formsptitels"><h2>{{ $value['value'] }}</h2></div>


								        @elseif( $value['type']=='relacion' )

								        	<div  id="relacion-{!! $value['relacion_campo'] !!}">

									        	<div class="col-md-12">
									                <label class="col-md-2 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
									                <div class="col-md-10" style="padding: 0px">
									                    
									                    <div class="col-md-4">
									                    
									                        <select data-plugin-selectTwo name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>

									                        	<option value="">Seleccione...</option>
									                        
										                    	<?php $aux1=$value['objkeys'][0]; $aux2=$value['objkeys'][1]; $objaux='' ?>

										                    	@if(isset($value['options']))

										                        	@foreach( $value['options'] as $key2 => $value2 )

										                        		<?php

										                        			if ($key2==0) {
										        								
										        								$objaux=$value2;
										        							}

										                        		?>


										                        		<option value="{!! $value2->$aux1 !!}" {{ ($value['value']==$value2->$aux1)? 'selected' : '' }}> {!! $value2->$aux2 !!} </option>

										                        	@endforeach

										                        @endif

									                    	</select>

									                    </div>

									                    <div class="col-md-8">

									                    	<button class="btn btn-success" name="relationadd" value="{!! $value['selectadd']['url'] !!}" data-relation="{!! $value['relacion_campo'] !!}">{!! $value['selectadd']['btnadd'] !!}</button>

									                        <button class="btn btn-primary" name="nextstep" value="{!! $value['selectadd']['url'] !!}"  data-idpointer="{!! $value['id'] !!}" data-finlabel="{!! $value['selectadd']['btnfinlavel'] !!}">{!! $value['selectadd']['btnlabel'] !!}</button>
									                    </div>


									                </div>
									            </div>



									        	<div class="col-md-12" id="relation-{{ $value['relacion_campo'] }}">

									        		<div class="deleted"></div>
									        		<div class="added">
									        			
									        			@if($value['relation_table']['table_obj']!=null)

							        						@foreach($value['relation_table']['table_obj'] as $relacionesp)

							        							<input type="hidden" name="addenin{{ $value['relacion_campo'] }}[]" value="{{ $relacionesp->$aux1 }}" id="addin{{ $relacionesp->$aux1 }}-{{ $value['relacion_campo'] }}">


							        						@endforeach

							        					@endif

									        		</div>
									        		
									        		<div class="">
									        			<div class="col-md-12">

									        				<h3>{{ $value['relation_table']['title'] }}</h3>

									        				<div class="tablecontainer">
									        					<table class="table table-bordered table-striped mb-none newrecords">

										        					<thead>
										        						<tr>
										        							@foreach($value['relation_table']['table_fields'] as $tablef)

										        								<th>{{$tablef}}</th>

										        							@endforeach

										        							<th></th>
										        						</tr>
										        					</thead>
										        					<tbody>

										        						<?php $auxstr=$value['relacion_campo']; ?>

										        						@if($value['relation_table']['table_obj']!=null)

											        						@foreach($value['relation_table']['table_obj'] as $relacionesp)

											        							<tr  id="tablereg{{ $relacionesp->$aux1 }}"  data-trueid="{{ $relacionesp->$aux1 }}">
											        								
											        								<td>{{ $relacionesp->$aux2 }}</td>
											        								<td class="tableregularbtns">
											        									<a href="#" class="btn btn-primary remove-row deleted-row btnver ocultos" data-visible="false" data-trueid="{{ $relacionesp->$aux1 }}" data-relation="{!! $value['relacion_campo'] !!}"><i class="fa fa-eye"></i></a>

											        									<a href="#" class="btn btn-danger remove-row deleted-row btnborrar" data-field-id="{{ $relacionesp->$aux1 }}"  data-trueid="{{ $relacionesp->$aux1 }}" data-relation="{!! $value['relacion_campo'] !!}"><i class="fa fa-trash-o"></i></a>
											        								</td>

											        							</tr>


											        						@endforeach

											        					@endif

										        					</tbody>

										        				</table>
									        				</div>
									        			</div>
									        		</div>


									        	</div>


									        </div>


								        @elseif( $value['type']=='muestra' )

								        	<div class="col-md-12 muestra-seccion">

							        			
							        			<div class="ocultos"><input type="file" name="imagenes[]"  multiple="true"></div>
							        			<div class="borrados"></div>


								        		<div class="">
								        			<div class="col-md-12">

								        				<h3>Registros Nuevos <button class="btn btn-default click" name="cargaimg">Agregar Archivos</button></h3>

								        				<div class="tablecontainer">
								        					<table class="table table-bordered table-striped mb-none newrecords">

									        					<thead>
									        						<tr>
									        							<th>Archivo</th>
									        							<th>Tipo de Archivo</th>
									        							<th>Tamaño</th>
									        							<th>Fecha de Registro</th>
									        							<th></th>
									        						</tr>
									        					</thead>
									        					<tbody>
									        					</tbody>

									        				</table>
								        				</div>
								        			</div>
								        		</div>


								        		@if(count($value['data'])>0)

									        		<div class="">
									        			<div class="col-md-12">

									        				<h3>Registros Existentes</h3>

									        				<div class="tablecontainer">
										        				<table class="table table-bordered table-striped mb-none">

										        					<thead>
										        						<tr>
										        							<th>Archivo</th>
										        							<th>Tipo de Archivo</th>
										        							<th>Tamaño</th>
										        							<th>Fecha de Registro</th>
										        							<th></th>
										        						</tr>
										        					</thead>
										        					<tbody>
										        						<?php

										        							$archi=$value['data']->archivo()->get();

										        							if (count($archi)>0) {
										        								
										        							
										        								foreach ($archi as $mkey => $muestra) {
										        								
										        									$ruta=base_path() .'/public/'.$muestra->ruta_img_muestra.$muestra->nombre_temporal_muestra;

										        									$extension=explode('.', $muestra->nombre_temporal_muestra);

										        									$rutaweb=$muestra->ruta_img_muestra.'visibles/'.str_replace($extension[1], 'jpg', $muestra->nombre_temporal_muestra);

										        									if (file_exists($ruta)) {
										        										$finfo = new finfo(FILEINFO_MIME);

												        								$type = explode(';', $finfo->file($ruta));

												        								echo "<tr id='tableregd".$mkey."' data-regid='d".$mkey."' data-trueid='".$muestra->id_archivo."'>";
													        								echo "<td>".$muestra->nombre_temporal_muestra."</td>";
													        								echo "<td>".$type[0]."</td>";
													        								echo "<td>".(filesize($ruta)/1000)."KB</td>";
													        								echo "<td>".$muestra->fecha_analisis."</td>";
													        								echo '<td>
													        									<a href="#" class="btn btn-primary remove-row deleted-row" data-visible="true" data-field-url="'.url($rutaweb).'"><i class="fa fa-eye"></i></a>
													        									<a href="#" class="btn btn-danger remove-row deleted-row" data-existfile="'.$mkey.'" data-field-id="d'.$mkey.'"><i class="fa fa-trash-o"></i></a>
													        								</td>';
													        							echo "</tr>";
										        									}

											        								

											        							}


											        						}
										        							


										        						?>
										        					</tbody>

										        				</table>
										        			</div>
									        			</div>
									        		</div>


								        		@endif
								        		
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
									                        <select data-plugin-selectTwo name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
									                            
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


									        	@if(isset($value['selectadd']))


								        			<div class="col-md-8">
										                <label class="col-md-3 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
										                <div class="col-md-8" style="padding: 0px">
										                    
										                    <div class="col-md-7">
										                    
										                        <select data-plugin-selectTwo name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>

										                        	<option value=" ">Seleccione...</option>
										                        
											                    	<?php $aux1=$value['objkeys'][0]; $aux2=$value['objkeys'][1] ?>

											                    	@if(isset($value['options']))

											                        	@foreach( $value['options'] as $key2 => $value2 )

											                        		<option value="{!! $value2->$aux1 !!}" {{ ($value['value']==$value2->$aux1)? 'selected' : '' }}> {!! $value2->$aux2 !!} </option>

											                        	@endforeach

											                        @endif

										                    	</select>

										                    </div>

										                    <div class="col-md-5">
										                        <button class="btn btn-primary" name="nextstep" value="{!! $value['selectadd']['url'] !!}" data-idpointer="{!! $value['id'] !!}" data-finlabel="{!! $value['selectadd']['btnfinlavel'] !!}">{!! $value['selectadd']['btnlabel'] !!}</button>
										                    </div>


										                </div>
										            </div>

										        @else

										        	<div class="col-md-6">
										                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
										                <div class="col-md-8">
										                    <select data-plugin-selectTwo name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
										                        
										                    	<?php $aux1=$value['objkeys'][0]; $aux2=$value['objkeys'][1] ?>

									                        	@foreach( $value['options'] as $key2 => $value2 )

									                        		<option value="{!! $value2->$aux1 !!}" {{ ($value['value']==$value2->$aux1)? 'selected' : '' }}> {!! $value2->$aux2 !!} </option>

									                        	@endforeach

										                    </select>
										                </div>
										            </div>

										        @endif

							        		@else


							        			<div class="col-md-6">
									                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
									                <div class="col-md-8">
									                    <select data-plugin-selectTwo name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}" @if (isset($value['validaciones'])) {!! $validaciones !!}  @endif>
									                            
								                        	@foreach( $value['options'] as $key2 => $value2 )

								                        		<option value="{!! $key2 !!}" {{ ($value['value']==$key2  && strlen($value['value'])==strlen($key2) )? 'selected' : '' }}> {!! $value2 !!} </option>

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

								@if(isset($request->stepform))

									<button class="btn btn-primary" name="lastcallmodal">{!! $request->finlabel !!}</button>
									<button class="btn btn-default dismisslastmodal">Regresar</button>

								@else

									<button class="btn btn-primary" name="finregistro">Finalizar Registro</button>
									<button class="btn btn-default modal-dismiss">Cancelar</button>

								@endif

							</div>
						</div>
					</footer>

				</div>

			@else

				<div class="mdl-truebody">
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

	    <script type="text/javascript">
	    	
	    	jQuery(document).ready(function() {

	    		$('[data-plugin-selectTwo]').each(function() {
							
					$(this).select2({
						allowClear: true,
						container:'#modalForm .mdl-truebody'
					});
				});


				$('.select2-drop').each(function(){

					$(this).addClass('select2-drop-superindex');

				});

				$('#modalForm .mdl-truebody').on('click' , function() { 
					$('[data-plugin-selectTwo]').each(function() {});
				} );

	    	})

	    </script>

    </section>

