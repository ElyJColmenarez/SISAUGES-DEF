@extends('layouts.app')
@section('title', 'Proyectos')
@section('content')

    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Reportes</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="get">

                    <div class="form-group col-md-12">
                        <h3>Tipo de reporte</h3>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Seleccione el Reporte</label>
                        <div class="col-md-6">
                            <select class="form-control populate">
                                <optgroup label="Reportes de Muestras">
                                    <option value="CA">FONACIT</option>
                                    <option value="CA">Regular</option>
                                    <option value="CA">Multiple</option>
                                    <option value="CA">Personalizado</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <h3>Configuraciones del Reporte</h3>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label col-md-4">
                            Campo X
                        </label>
                        <div class="col-md-8">
                            <div class="switch switch-sm switch-primary col-md-3">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 center">
                        <button class="btn btn-primary">Generar Reporte</button>
                    </div>

                    </form>
                </div>
            </section>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Specific Page Vendor -->
    <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
    <script src="assets/vendor/select2/select2.js"></script>
    <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
    <script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="assets/vendor/fuelux/js/spinner.js"></script>
    <script src="assets/vendor/dropzone/dropzone.js"></script>
    <script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
    <script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
    <script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <script src="assets/vendor/codemirror/lib/codemirror.js"></script>
    <script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
    <script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
    <script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
    <script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="assets/vendor/codemirror/mode/css/css.js"></script>
    <script src="assets/vendor/summernote/summernote.js"></script>
    <script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
@endpush