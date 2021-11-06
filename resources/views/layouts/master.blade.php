<!DOCTYPE html>
<?php
$modulos = session('sesion_usuario');
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title>{{ config('constants.NOMBRE_APP') }} | @yield('title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />





    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('DataTables/responsivedataTablesmin.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('DataTables/datatables.js') }}"></script>
	<script type="text/javascript" charset="utf8" src="{{ asset('DataTables/dataTablesresponsivemin.js') }}"></script>
	<!-- librerias para los botones de javascript -->
	<script src="{{ asset('DataTables/response/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('DataTables/response/jszip.min.js') }}"></script>
	<script src="{{ asset('DataTables/response/pdfmake.min.js') }}"></script>
	<script src="{{ asset('DataTables/response/vfs_fonts.js') }}"></script>
	<script src="{{ asset('DataTables/response/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('DataTables/response/buttons.print.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/master.css') }}" />
    <script src="{{ asset('js/funciones.js') }}"></script>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ config('constants.NOMBRE_APP') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#itemsMenu" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="itemsMenu">
                <div class="navbar-nav ml-auto">
                    @foreach ( $modulos['modulos']  as $modulo )
                        <a class="nav-link" href="{{ route($modulo->ruta) }}"><i class="{{ $modulo->icono }}"></i> {{ $modulo->modulo }}</a>
                    @endforeach
                    <a class="nav-link" href="{{ route('usuarios.cerrar') }}"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container contenido-vista">
        @yield('content')
    </div>
</body>
</html>
