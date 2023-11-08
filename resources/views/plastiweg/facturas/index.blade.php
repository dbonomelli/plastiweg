@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - FACTURACIÓN
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
{{-- Body --}}
@section('main')
<div class="container-fluid">
    <div class="d-md-flex justify-content-md-center">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h3>Registro de Facturas</h3>
                    </div>
                </div>
                <div class="row mt-4">
                    <form method="GET" action="{{ route('facturas.buscar') }}">
                      @csrf
                      <div class="row">
                        <div class="col-auto" >
                          <input class="form-control" type="text" id="numFactura" name="numFactura" placeholder="Ingrese n° de factura" style="width: fit-content">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success" style= "float: right;">Buscar</button>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('facturas.create') }}" class="btn btn-primary mt-4">Nueva Factura</a>
                        </div>
                    </div>
                </div>
                <div class="row pagination" style="display: grid; place-items: center;">
                    <div class="col-auto">
                      {{ $facturas->links() }}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped table-bordered border-info table-hover" style="width: fit-content">
                        <thead class="thead-dark">
                            <tr>
                                <th style='background-color: #07342F;'>#</th>
                                <th style='background-color: #07342F;'>FECHA</th>
                                <th style='background-color: #07342F;'>FACTURA</th>
                                <th style='background-color: #07342F;'>CLIENTE</th>
                                <th style='background-color: #07342F;'>MONTO TOTAL</th>
                                <th style='background-color: #07342F;'>PAGO TOTAL REALIZADO</th>
                                <th style='background-color: #07342F;'>FECHA ÚLTIMO PAGO</th> 
                                <th style='background-color: #07342F;'>ÚLTIMO PAGO REALIZADO</th> 
                                <th style='background-color: #07342F;'></th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $num=>$factura)
                                <tr>
                                    <th>{{ $num + 1 }}</th>
                                    <td>{{ $factura ->fecha_creacion }}</td>
                                    <td>{{ $factura ->num_factura }}</td>
                                    <td>{{ $factura ->nombre_cliente }}</td>
                                    <td>{{ $factura ->monto_total }}</td>
                                    @if ($factura ->monto_total > $factura ->pago_total_realizado)
                                        <td><b style="background-color: rgb(255, 119, 119);">{{ $factura ->pago_total_realizado }}</b></td>
                                    @else
                                        <td><b style="background-color: rgb(191, 252, 156); color: black">{{ $factura ->pago_total_realizado }}</b></td>
                                    @endif
                                    <td>{{ $factura->fecha_ultimo_pago }}</td>
                                    <td>{{ $factura->ultimo_pago }}</td>
                                    {{-- <td><a class='btn btn-info' href="{{ route('factura.create',  $factura->num_factura) }}">Agregar pago</a></td> --}}
                                    <td style="width: 5%">
                                        @if ($factura ->monto_total > $factura ->pago_total_realizado)
                                            <a class='btn btn-sm btn-info' href="{{ route('facturas.edit', $factura->id_factura) }}">Agregar pago</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row pagination" style="display: grid; place-items: center;">
        <div class="col-auto">
          {{ $facturas->links() }}
        </div>
    </div>
</div> 
@endsection
{{-- Fin Body --}}
{{--  --}}
