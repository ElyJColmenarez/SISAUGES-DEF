<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>SISAUGES-MEB</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/form-elements.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{url('assets/ico/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('assets/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('assets/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('assets/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{url('assets/ico/apple-touch-icon-57-precomposed.png')}}">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Bienvenido</strong>!!!</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Login</h3>
                            <p>Introduzca su nombre se usuario y contraseña:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-key"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="{{ url('/login') }}" method="post" class="login-form">

                            {!! csrf_field() !!}

                            @if(count($errors) > 0)
                                <div class="alert alert-danger" id="myerrors">
                                    <strong>Uppss!</strong>Hay algunos problemas con los datos que ingresaste<br><br>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error  }}</li>
                                        @endforeach
                                    </ul>

                                </div>
                            @endif

                            <div class="form-group">
                                <label class="sr-only" for="username">Usuario</label>
                                <input type="text" name="username" placeholder="Usuario..." class="username form-control @if(count($errors) > 0) input-error @endif" id="username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="password">Contraseña</label>
                                <input type="password" name="password" placeholder="Contraseña..." class="password form-control @if(count($errors) > 0) input-error @endif" id="password">
                            </div>
                            <button type="submit" class="btn">Iniciar Sesión!</button>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{{ url('assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/js/jquery.backstretch.min.js') }}"></script>
<script src="{{ url('assets/js/scripts.js') }}"></script>

<!--[if lt IE 10]>
<script src="{{ url('assets/js/placeholder.js')}}"></script>
<![endif]-->

</body>

</html>