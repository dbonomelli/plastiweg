@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - AJUSTE STOCK
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
                            <a href="{{ route('productos.inventario') }}" class="btn btn-warning mt-4">VOLVER</a>
                            <a href="{{ route('ajuste.create') }}" class="btn btn-success mt-4">CREAR AJUSTE</a>
                        </div>
                    </div>
                </div>
                <div class="row pagination" style="display: grid; place-items: center;">
                    <div class="col-auto">
                      {{ $ajustes->links() }}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped table-bordered border-info table-hover" style="width: fit-content">
                        <thead class="thead-dark">
                            <tr>
                                <th style='background-color: #07342F;'>#</th>
                                <th style='background-color: #07342F;'>PRODUCTO</th>
                                <th style='background-color: #07342F;'>TIPO DE AJUSTE</th>
                                <th style='background-color: #07342F;'>FECHA DEL AJUSTE</th>
                                <th style='background-color: #07342F;'>CANTIDAD</th>
                                <th style='background-color: #07342F;'>MOTIVO</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ajustes as $num=>$ajuste)
                                <tr>
                                    <th>{{ $num + 1 }}</th>
                                    <td>{{ $ajuste ->nombre_producto }}</td>
                                    @if ($ajuste->tipo_ajuste == "1")
                                        <td>INGRESO</td>
                                    @else
                                        <td>EGRESO</td>
                                    @endif
                                    <td>{{ $ajuste->fecha_ajuste }}</td>
                                    <td>{{ $ajuste->cantidad_ajuste }}</td>
                                    @if ($ajuste->motivo_ajuste == "1")
                                        <td>ABASTECIMIENTO</td>
                                    @elseif ($ajuste->motivo_ajuste == "2")
                                        <td>PÉRDIDA</td>
                                    @else
                                        <td>DEPRECIACIÓN</td>
                                    @endif
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
          {{ $ajustes->links() }}
        </div>
    </div>
</div> 
@endsection
{{-- Fin Body --}}
{{--  --}}
