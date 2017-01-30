<!doctype html>
<html class="fixed sidebar-left-collapsed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>SISAUGES-MEB</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="author" content="okler.net">
        <link rel="shortcut icon" href="{{url('assets/ico/favicon.png')}}">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{url('assets/vendor/bootstrap/css/bootstrap.css')}}" />
        <link rel="stylesheet" href="{{url('assets/vendor/font-awesome/css/font-awesome.css')}}" />
        <link rel="stylesheet" href="{{url('assets/vendor/magnific-popup/magnific-popup.css')}}" />
        <link rel="stylesheet" href="{{url('assets/vendor/bootstrap-datepicker/css/datepicker3.css')}}" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{{url('assets/vendor/select2/select2.css')}}" />
        <link rel="stylesheet" href="{{url('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')}}" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{url('assets/stylesheets/theme.css')}}" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="{{url('assets/stylesheets/skins/default.css')}}" />
        <link rel="stylesheet" href="{{url('assets/stylesheets/sisauges-meb-styles.css')}}" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{{url('assets/stylesheets/theme-custom.css')}}">

        <!-- Head Libs -->
        <script src="{{ url('assets/vendor/modernizr/modernizr.js')}}"></script>

    </head>
    <body>
        <section class="body">

            <!-- start: header -->
            <header class="header">

                <div class="princpl-bnr"></div>

            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                
                    @include('layouts.sidebar')

                <!-- end: sidebar -->

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Principal</h2>
                    
                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="{{url('index.html')}}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                            </ol>
                    
                            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                        </div>
                    </header>

                    <!-- start: page -->

                        @yield('content')

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

            <!-- Vendor -->
            <script src="{{ url('assets/vendor/jquery/jquery.js')}}"></script>
            <script src="{{ url('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
            <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
            <script src="{{ url('assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
            <script src="{{ url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
            <script src="{{ url('assets/vendor/magnific-popup/magnific-popup.js')}}"></script>
            <script src="{{ url('assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>
            
            <!-- Specific Page Vendor -->

            <script src="{{ url('assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js')}}"></script>
            <script src="{{ url('assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js')}}"></script>
            <script src="{{ url('assets/vendor/jquery-appear/jquery.appear.js')}}"></script>
            <script src="{{ url('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
            <script src="{{ url('assets/vendor/jquery-easypiechart/jquery.easypiechart.js')}}"></script>
            <script src="{{ url('assets/vendor/flot/jquery.flot.js')}}"></script>
            <script src="{{ url('assets/vendor/flot-tooltip/jquery.flot.tooltip.js')}}"></script>
            <script src="{{ url('assets/vendor/flot/jquery.flot.pie.js')}}"></script>
            <script src="{{ url('assets/vendor/flot/jquery.flot.categories.js')}}"></script>
            <script src="{{ url('assets/vendor/flot/jquery.flot.resize.js')}}"></script>
            <script src="{{ url('assets/vendor/jquery-sparkline/jquery.sparkline.js')}}"></script>
            <script src="{{ url('assets/vendor/raphael/raphael.js')}}"></script>
            <script src="{{ url('assets/vendor/morris/morris.js')}}"></script>
            <script src="{{ url('assets/vendor/gauge/gauge.js')}}"></script>
            <script src="{{ url('assets/vendor/snap-svg/snap.svg.js')}}"></script>
            <script src="{{ url('assets/vendor/liquid-meter/liquid.meter.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/jquery.vmap.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/jquery.vmap.world.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')}}"></script>
            <script src="{{ url('assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')}}"></script>
            <script src="{{url('assets/vendor/pnotify/pnotify.custom.js' )}}"></script>
            <script src="{{url('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js' )}}"></script>
            <script src="{{url('assets/vendor/jquery-datatables-bs3/assets/js/datatables.js' )}}"></script>
            <script src="{{url('assets/vendor/select2/select2.js' )}}"></script>
            <script src="{{url('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js' )}}"></script>
            <script src="{{url('assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js' )}}"></script>
            <script type="text/javascript" src="{{url('assets/js/main_sisauges_meb.js' )}}"></script>

            
            <!-- Theme Base, Components and Settings -->
            <script src="{{ url('assets/javascripts/theme.js')}}"></script>
            
            <!-- Theme Custom -->
            <script src="{{ url('assets/javascripts/theme.custom.js')}}"></script>
            
            <!-- Theme Initialization Files -->
            <script src="{{ url('assets/javascripts/theme.init.js')}}"></script>

            <!-- Examples -->
            <script src="{{url('assets/javascripts/tables/examples.datatables.ajax.js' )}}"></script>
            <script src="{{ url('assets/javascripts/dashboard/examples.dashboard.js')}}"></script>
            <script src="{{url('assets/javascripts/ui-elements/examples.modals.js' )}}"></script>
            <script src="{{url('assets/javascripts/tables/examples.datatables.editable.js' )}}"></script>
            <script src="{{url('assets/javascripts/ui-elements/examples.modals.js' )}}"></script>
            <script src="{{url('assets/javascripts/tables/examples.datatables.default.js' )}}"></script>
            <script src="{{url('assets/javascripts/tables/examples.datatables.row.with.details.js' )}}"></script>
            <script src="{{url('assets/javascripts/tables/examples.datatables.tabletools.js' )}}"></script>
            @stack('scripts')

        </section>
    </body>
</html>