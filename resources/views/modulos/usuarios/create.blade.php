@extends('layouts.master')

@section('title','REGISTRO USUARIO')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h4>Registro Usuario</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                            <a class="btn btn-info btn-md negrita" href="{{ route('usuarios.index') }}">Listado Usuarios</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('flash_error'))
                        <div class="alert alert-danger negrita">
                            {{Session::get('flash_error')}}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="documento">documento</label>
                                    <input type="text" class="form-control" id="documento" name="documento" onkeypress="return Funciones.isNumberKey(event)" placeholder="Digite el # de documentos sin espacios ni puntos" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo"  required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"  required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="rol">Rol</label>
                                    <select class="form-control" id="rol" name="rol" required>
                                        <option value="">Seleccione un rol:</option>
                                        @foreach ( $roles as $rol)
                                            <option value="{{ $rol->id  }}">{{ $rol->rol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary btn-md btn-guardar">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        @if(Session::has('flash_error'))
            Funciones.esconderAlertBootstrap();
        @endif
    </script>
@stop





