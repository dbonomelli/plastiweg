@extends('layout.master')

@section('title')
Plastiweb - clientes
@endsection

<head>
    <link type="text/css" href="{{ asset('public/css/clientes/index.css') }}" rel="stylesheet">
</head>

@section('main')
    <div class="container-fluid">
        <div class="row text-center">
            <h2>Clientes</h2>
        </div>
        <div class="d-md-flex justify-content-md-center">
            <div class="row">
                <div class="col-auto" style="width: fit-content">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="d-md-flex justify-content-md-end">
                                <a href="{{ route("cliente.createCliente") }}" class='btn btn-warning'>Registrar Cliente</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $clientes->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-striped table-hover" style="width: fit-content">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                        <th>Direccion</th>
                                        <th>Acción</th>   
                                    </tr>
                                </thead>
                                <tbody class="table-warning table-group-divider">
                                    @foreach ($clientes as $client )
                                       <tr>
                                           <td>{{ $client->rut }}</td>
                                           <td>{{ $client->nombre_cliente }}</td>
                                           <td>{{ $client->apellido_cliente  }}</td>
                                           <td>{{ $client->telefono_contacto_cliente }}</td>
                                           <td>{{ $client->correo  }}</td>
                                           <td>{{ $client->direccion_cliente }}</td>
                                           <td>
                                               <a href="{{ route('cliente.show', $client->id_cliente) }}" class="btn btn-sm btn-info">Detalle</a>
                                           </td>
                                       </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $clientes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
