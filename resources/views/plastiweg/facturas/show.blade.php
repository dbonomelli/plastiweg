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
                <div class="row mb-3">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cliente') }}" class="btn btn-warning" style="width: fit-content">Volver</a>
                            <a href="" class="btn btn-success mt-4">Nueva Factura</a>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $num=>$factura)
                                <tr>
                                    <th>{{ $num + 1 }}</th>
                                    <td>{{ $factura ->fecha }}</td>
                                    <td>{{ $factura ->num_factura }}</td>
                                    <td>{{ $factura ->nombre_cliente }}</td>
                                    <td>{{ $factura ->monto_total }}</td>
                                    @if ($factura ->monto_total > $factura ->pago_total_realizado)
                                        <td style="background-color: rgb(255, 119, 119);"><b>{{ $factura ->pago_total_realizado }}</b></td>
                                    @else
                                        <td>{{ $factura ->pago_total_realizado }}</td>
                                    @endif
                                    
                                    <td>{{ $factura->fecha_ultimo_pago }}</td>
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
