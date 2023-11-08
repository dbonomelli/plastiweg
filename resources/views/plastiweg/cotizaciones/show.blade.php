@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - Cotizacion
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
<head>
    <link type="text/css" href="{{ asset('public/css/cotizacion/show.css') }}" rel="stylesheet">
</head>
@section('main')
<section class="appointment-area">
    <div class="container">
        <div class="row" style="justify-content: center;"> 
            <div class="col-lg-6 col-sm-12 p-0">
                <div class="appointment-here-form">					
                    <h3>DETALLE COTIZACION DE CLIENTE</h3><br>
                    <div class="contact-wrap contact-pages mb-0">
                        <div class="contact-form">
                            <form method="POST" action="#">
                                @csrf
                                <div class="row">
                                    <div class="card">
                                        <div style="text-align: center;text-align: -webkit-center;">
                                            <div class="col col-md-7" style="color: black">
                                                <div class="card-body">
                                                    <div >
                                                        <h5 class="card-title font-size-22 font-weight-bold mt-2 mb-0">N° Cotización: {{$cotizacionN}}</h5>
                                                        <h5 class="card-title font-size-22 font-weight-bold mt-2 mb-0"><small> Señor(es) o Empresa: {{$nombre_cliente}} </small>
                                                        </h5>
                                                        <div class="data-atencion">
                                                            <div class="card-text">
                                                                <span>Fecha: {{$fecha}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caja-vendor">
                                            <div class="header-caja-vendor">
                                                <img alt="" class="logo-vendor" src="#">
                                            </div>
                                            <div>
                                                <div class="table-responsive pharmacy-table px-4 py-2">
                                                    <table class="table m-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Articulos</th>
                                                                <th>Cantidad</th>
                                                                <th style="text-align: right;">Precio</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($detalle as $num=>$detalle )
                                                            <tr>
                                                                <td>{{ $num+1 }}</td>
                                                                <td>{{ $detalle->nombre_producto }}</td>
                                                                <td>{{ $detalle->cantidad }}</td>
                                                                <td>{{ $detalle->subtotal }}</td>
                                                                <td>Editar</td>
                                                                <td>Eliminar</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tbody>
                                                            <tr class="total-drugs">
                                                                <td><span>Total</span></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="total-valor">{{$valor_total}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div style='display: -webkit-inline-box;'>
                                <a  href='{{ route('cotizaciones.seguir') }}'class="btn btn-warning btn-sm"> Volver </a>
                                <form method="POST" action="{{ route('cotizaciones.descarga') }}">
                                    @csrf
                                    <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacionN}} readonly="readonly" hidden= "true">
                                    <button type="submit" id="btnExport" disabled name="export" value="export to excel" class="btn btn-primary btn-sm"> 
                                        Emitir cotizacion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
{{-- Fin Body --}}
