	<section class="panel">
									

		{!!Form::open(['url'=>$action, 'class'=>'form-horizontal form-bordered', 'method' => 'post', 'id'=>'modalmicroform'])!!}

	        <header class="panel-heading">
				<h2 class="panel-title">Registration Form</h2>
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

						<div class="formcontent">
					        @foreach( $fields as $key => $value )

					        	@if( $value['type']=='text' )

					        		<div class="form-group col-md-6">
						                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
						                <div class="col-md-8">
						                    <input type="{!! $value['type'] !!}" class="form-control" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}">
						                </div>
						            </div>

						        @elseif( $value['type']=='hidden' )

						        	<input type="{!! $value['type'] !!}" class="form-control" id="{!! $value['id'] !!}" name="{!! $key !!}" value="{!! $value['value'] !!}">

					        	@elseif( $value['type']=='select' )

					        		@if(isset($value['extrafields']))

					        			<div class="form-group col-md-6">
							                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
							                <div class="col-md-8" style="padding: 0px">
							                    
							                    <div class="col-md-4">
							                        <select data-plugin-select name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}">
							                            
							                        	@foreach( $value['options'] as $key2 => $value2 )

							                        		<option value="{!! $key2 !!}" {{ ($value['value']==$key2)? 'selected' : '' }}> {!! $value2 !!} </option>

							                        	@endforeach

							                        </select>
							                    </div>
							                    @foreach( $value['extrafields'] as $key2 => $value2 )

								                    <div class="col-md-8">
								                        <input type="text" class="form-control" id="{!! $value2['name'] !!}" name="{!! $value2['name'] !!}" value="{!! $value2['value'] !!}" placeholder="{!! $value2['placeholder'] !!}">
								                    </div>

								                @endforeach

							                </div>
							            </div>

					        		@else


					        			<div class="form-group col-md-6">
							                <label class="col-md-4 control-label" for="{!! $key !!}">{!! $value['label'] !!}</label>
							                <div class="col-md-8">
							                    <select data-plugin-select name="{!! $key !!}" id="{!! $value['id'] !!}" class="form-control populate" value="{!! $value['value'] !!}">
							                            
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

