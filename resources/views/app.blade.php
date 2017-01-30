<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SISAUGES-@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">
    @if(Auth::check())

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">SISAUGES</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Inicio</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tesistas<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::to('crearTesista')}}">Agregar Tesistas</a></li>
                            <li><a href="{{URL::to('crearClasificacionActividad')}}">Agregar Tesistas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuarios<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::to('crearUsuario')}}">Agregar Usuarios</a></li>
                        </ul>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Representante<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{URL::to('crearRepresentante')}}">Agregar Representante</a></li>
                        </ul>
                    </li>
                    </li>
                    <li><a href="{{URL::to('logout')}}"><span class="glyphicon glyphicon-log-out"></span>Salir</a></li>

                </ul>
            </div>
        </div>
    </nav>
    @endif
@yield('content')
    <script src="{{asset ('bower_components/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset ('bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
    <link href="{{asset ('bower_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    @stack('scripts')

</div>
