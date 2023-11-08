@php
    $num_venta = $venta;
@endphp
@extends('layout.master')
{{--  --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/> --}}

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - Cotizacion
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}

@section('main')
<div class="container-fluid">
    <div class="row text-center">
        <h3>EMISION DE VENTA</h3>
    </div>
    <div class="d-md-flex justify-content-md-center">
        <div class="row">
            <div class="col-auto" style="width: fit-content">
                <div class="card border-primary" style="width: fit-content">
                    <div class="card-body">
                        <div class="row">
                            <div style="display: flex; justify-content: center; align-items: center">
                                <div class="col" style="width: fit-content">
                                    <h5 class="card-title" style="color: black; text-align: center">Señor(a) o Empresa: {{$cliente->nombre_cliente}}</h5>
                                    <p class="card-text" style="color: black; text-align: center">N° Venta: {{$venta}}</p>
                                    <p style="color: black; text-align: center; font-size: small">Fecha: {{$fecha}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-md-flex justify-content-md-center">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mt-4" style="width: fit-content">
                                            <thead class="table-info">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Articulos</th>
                                                    <th>Cantidad</th>
                                                    <th style="text-align: right;">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-warning">
                                                @foreach ($detalles as $num=>$detalle )
                                                    <tr>
                                                        <td>{{ $num+1 }}</td>
                                                        <td>{{ $detalle->nombre_producto }}</td>
                                                        <td>{{ $detalle->cantidad }}</td>
                                                        <td>{{ $detalle->subtotal }}</td>
                                                    </tr>    
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2"><span>Neto</span></td>
                                                    <td class="total-valor">{{$valor_total}}</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2"><span>Iva</span></td>
                                                    <td class="total-valor">{{$iva_total}}</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2"><span>Total</span></td>
                                                    <td class="total-valor"><b>{{$pago_total}}</b></td>
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-between">
                                    <form method="POST" action="{{ route('ventas.export') }}">
                                        @csrf
                                        <input class="form-control" type="text" id="num_venta" name="num_venta" value={{$num_venta}} readonly="readonly" hidden= "true">
                                        <button type="submit" class="btn btn-primary btn-sm"> 
                                            Emitir venta
                                        </button>
                                    </form>
                                    <a  href="{{ route("cotizaciones") }}" class="btn btn-success btn-sm">Continuar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>


@endsection
{{-- Fin Body --}}