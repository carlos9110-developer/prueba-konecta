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
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                    @if($errors->has('nombre'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('nombre') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="documento">documento</label>
                                    <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento') }}" onkeypress="return Funciones.isNumberKey(event)" placeholder="Digite el # de documentos sin espacios ni puntos" required>
                                    @if($errors->has('documento'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('documento') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}"  required>
                                    @if($errors->has('correo'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('correo') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}"  required>
                                    @if($errors->has('direccion'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('direccion') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="rol">Rol</label>
                                    <select class="form-control" id="rol" name="rol" required>
                                        <option value="">Seleccione un rol:</option>
                                        @foreach ( $roles as $rol)
                                            <option value="{{ $rol->id  }}"   {{ ( $rol->id == old('rol')) ? 'selected' : '' }}>{{ $rol->rol }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('rol'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('rol') }}
                                        </small>
                                    @endif
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





