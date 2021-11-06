@extends('layouts.master')

@section('title','CLIENTES')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h4>Clientes</h3>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                            <a class="btn btn-info btn-md negrita" href="{{ route('clientes.create') }}">Registrar Cliente</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('flash_succees'))
                        <div class="alert alert-success negrita">
                            {{Session::get('flash_succees')}}
                        </div>
                    @endif
                    <div class="table-responsive-sm">
                        <table id="tbl_clientes" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function inicio()
        {
            $('#tbl_clientes').DataTable({
                processing: true,
                responsive:Funciones.determinarResponsive(600),
                serverSide: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('clientes.index') }}",
                },
                language: Funciones.retornarIdiomaDatatable(),
                columns: [
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'documento',
                        name: 'documento'
                    },
                    {
                        data: 'correo',
                        name: 'correo'
                    },
                    {
                        data: 'direccion',
                        name: 'direccion'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });
        }
        inicio();
        @if(Session::has('flash_succees'))
            Funciones.esconderAlertBootstrap();
        @endif
    </script>
@stop

