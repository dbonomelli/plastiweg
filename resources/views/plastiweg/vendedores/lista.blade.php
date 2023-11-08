@extends('layout.master')

@section('title')
Plastiweb - vendedores
@endsection

<head>
    <link type="text/css" href="{{ asset('public/css/vendedores/lista.css') }}" rel="stylesheet">
</head>

@section('main')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="d-flex justify-content-center">
                <h2>Listado Vendedores</h2>
            </div>
        </div>
        <div class="d-md-flex justify-content-md-center">
            <div class="row">
                <div class="col-auto" style="width: fit-content">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="d-md-flex justify-content-md-end">
                                <a href="{{ route('vendedor.create') }}" class="btn btn-warning">Agregar Vendedor</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $vendedores->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-striped" style="width: fit-content">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombre vendedor</th>
                                        <th>Apellido vendedor</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
                                        <th>Acción</th>  
                                    </tr>
                                </thead>
                                <tbody class="table-warning table-group-divider">
                                    @foreach ($vendedores as $vendedor )
                                        <tr>
                                            <td>{{ $vendedor->nombre_vendedor }}</td>
                                            <td>{{ $vendedor->apellido_vendedor }}</td>
                                            <td>{{ $vendedor->usuario  }}</td>
                                            <td> ****** </td>
                                            <td><a href="{{ route('vendedor.show', $vendedor->id_vendedor) }}" class="btn btn-sm btn-info">Detalle</a></td>
                                        </tr>
                                     @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $vendedores->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
