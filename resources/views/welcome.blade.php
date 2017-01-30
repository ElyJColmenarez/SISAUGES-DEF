@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-6 col-lg-12 col-xl-6">
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="chart-data-selector" id="salesSelectorWrapper">
                                    <h2>
                                        Proyectos:
                                        <strong>
                                            <select class="form-control" id="salesSelector">
                                                <option value="Porto Admin" selected>2014</option>
                                                <option value="Porto Drupal" >2015</option>
                                                <option value="Porto Wordpress" >2016</option>
                                            </select>
                                        </strong>
                                    </h2>

                                    <div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
                                        <!-- Flot: Sales Porto Admin -->
                                        <div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active"></div>
                                        <script>

                                            var flotDashSales1Data = [{
                                                data: [
                                                    ["Jan", 5],
                                                    ["Feb", 10],
                                                    ["Mar", 2],
                                                    ["Apr", 3],
                                                    ["May", 8],
                                                    ["Jun", 15],
                                                    ["Jul", 1],
                                                    ["Aug", 7],
                                                    ["Sep", 10],
                                                    ["Oct", 11],
                                                    ["Nov", 20],
                                                    ["Dic", 17]
                                                ],
                                                color: "#0088cc"
                                            }];

                                            // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                        </script>

                                        <!-- Flot: Sales Porto Drupal -->
                                        <div class="chart chart-sm" data-sales-rel="Porto Drupal" id="flotDashSales2" class="chart-hidden"></div>
                                        <script>

                                            var flotDashSales2Data = [{
                                                data: [
                                                    ["Jan", 2],
                                                    ["Feb", 2],
                                                    ["Mar", 0],
                                                    ["Apr", 7],
                                                    ["May", 8],
                                                    ["Jun", 12],
                                                    ["Jul", 15],
                                                    ["Aug", 10],
                                                    ["Sep", 7],
                                                    ["Oct", 0],
                                                    ["Nov", 0],
                                                    ["Dic", 5]
                                                ],
                                                color: "#0088cc"
                                            }];

                                            // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                        </script>

                                        <!-- Flot: Sales Porto Wordpress -->
                                        <div class="chart chart-sm" data-sales-rel="Porto Wordpress" id="flotDashSales3" class="chart-hidden"></div>
                                        <script>

                                            var flotDashSales3Data = [{
                                                data: [
                                                    ["Jan", 1],
                                                    ["Feb", 10],
                                                    ["Mar", 20],
                                                    ["Apr", 20],
                                                    ["May", 12],
                                                    ["Jun", 5],
                                                    ["Jul", 0],
                                                    ["Aug", 3],
                                                    ["Sep", 7],
                                                    ["Oct", 2],
                                                    ["Nov", 5],
                                                    ["Dic", 10]
                                                ],
                                                color: "#0088cc"
                                            }];

                                            // See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

                                        </script>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-6 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <section class="panel panel-featured-left panel-featured-primary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-primary">
                                            <i class="fa fa-picture-o"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Muestras Totales</h4>
                                            <div class="info">
                                                <strong class="amount">1281</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(ver todas)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <section class="panel panel-featured-left panel-featured-secondary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-secondary">
                                            <i class="fa fa-university"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Instituciones Afiliadas</h4>
                                            <div class="info">
                                                <strong class="amount">200</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(ver)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <section class="panel panel-featured-left panel-featured-tertiary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-tertiary">
                                            <i class="fa fa-cube"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Proyectos Solicitados este Mes:</h4>
                                            <div class="info">
                                                <strong class="amount">18</strong>
                                                <span class="text-primary">(10 pendientes)</span>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(ver todos)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <section class="panel panel-featured-left panel-featured-quartenary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-quartenary">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Usuarios Registrados</h4>
                                            <div class="info">
                                                <strong class="amount">20</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(ver)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
@endsection
