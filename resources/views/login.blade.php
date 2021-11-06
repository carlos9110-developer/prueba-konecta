<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title>{{ config('constants.NOMBRE_APP') }} | LOGIN </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <!-- toastr -->
    <link href="{{ asset('toastr/toastr.min.css') }}"  rel="stylesheet">
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <script src="{{ asset('js/funciones.js') }}"></script>
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">

            <h2 class="text-info text-center">
                Inicio De Sesión
            </h2>

            <!-- Login Form -->
            <form id="form-login" name="form-login" method="post" action="{{ route('usuarios.procesar_login') }}">
                @csrf
                <input type="hidden" id="ruta_inicio" value="">
                <input type="text" id="email" class="fadeIn second" name="email" placeholder="email" required>
                <input type="text" id="clave" class="fadeIn third" name="clave" placeholder="password" required>
                <select name="rol" id="rol" class="form-control fadeIn third" required>
                    <option value="">Seleccione el rol</option>
                    <option value="1">Administrador</option>
                    <option value="2">Vendedor</option>
                </select>
                <input id="submitLogin" type="submit" class="fadeIn fourth" value="Entrar">
            </form>


            @if(Session::has('flash_error'))
                <div class="alert alert-danger negrita">
                    {{Session::get('flash_error')}}
                </div>
            @endif

            <!-- Remind Passowrd -->
            <div id="formFooter">
            </div>

        </div>
    </div>

    <script>
        @if(Session::has('flash_error'))
            Funciones.esconderAlertBootstrap();
        @endif
    </script>

</body>
</html>
