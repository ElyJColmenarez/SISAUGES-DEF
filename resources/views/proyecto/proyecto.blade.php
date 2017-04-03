@extends('layouts.app')
@section('title', 'Proyectos')
@section('content')
   

    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Rows with Details</h2>
        </header>
				

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Principal</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

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
								<section class="panel">
									<header class="panel-heading">
										<h2 class="panel-title">Registration Form</h2>
									</header>
									<div class="panel-body">
										<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
											<div class="form-group mt-lg">
												<label class="col-sm-3 control-label">Name</label>
												<div class="col-sm-9">
													<input type="text" name="name" class="form-control" placeholder="Type your name..." required/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Email</label>
												<div class="col-sm-9">
													<input type="email" name="email" class="form-control" placeholder="Type your email..." required/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">URL</label>
												<div class="col-sm-9">
													<input type="url" name="url" class="form-control" placeholder="Type an URL..." />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Comment</label>
												<div class="col-sm-9">
													<textarea rows="5" class="form-control" placeholder="Type your comment..." required></textarea>
												</div>
											</div>
										</form>
									</div>
									<footer class="panel-footer">
										<div class="row">
											<div class="col-md-12 text-right">
												<button class="btn btn-primary modal-confirm">Submit</button>
												<button class="btn btn-default modal-dismiss">Cancel</button>
											</div>
										</div>
									</footer>
								</section>
							</div>

					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>

			
			@endsection