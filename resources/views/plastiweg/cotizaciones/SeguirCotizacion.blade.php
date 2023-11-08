@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - COTIZACIONES
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
<head>
    <link type="text/css" href="{{ asset('public/css/cotizacion/seguir.css') }}" rel="stylesheet">
</head>
{{--  --}}
{{-- Body --}}
@section('main')
<section class="appointment-area">
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <div class="col-auto">
                <a href="{{route('cotizaciones')}}" class="btn btn-warning" style="float: left">volver</a>
            </div>
            <div class="col">
                <h3>SEGUIR COTIZACIONES</h3>
            </div>
        </div>
        <div class="row mt-4">
            <form method="POST" action="{{ route('cotizaciones.buscarSeguimientoCotizacion') }}">
              @csrf
              <div class="row">
                <div class="col-auto" >
                  <input class="form-control" type="text" id="nom_cliente" name="nom_cliente" maxlength="45" placeholder="Ingrese nombre cliente" style="width: fit-content">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success" style= "float: right;">Buscar</button>
                </div>
              </div>
            </form>
        </div>
        <div class="">
            <div class="row mt-2">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-dark table-bordered" style="width: fit-content">
                            <thead>
                                <tr>
                                    <th style='background-color: #026b5a;'>#</th>
                                    <th style='background-color: #026b5a;'>CLIENTE</th>
                                    <th style='background-color: #026b5a;'>NUMERO DE COTIZACION</th>
                                    <th style='background-color: #026b5a;'>FECHA DE EMISION</th>
                                    <th style='background-color: #026b5a;'>ESTADO</th>
                                    <th style='background-color: #026b5a;'>TOTAL</th>
                                    <th style='background-color: #026b5a;'>ACCION</th>     
                                </tr>
                            </thead>
                            <tbody class="table-warning">
                                @foreach ($cotizaciones as $num=>$cotizacion )
                                    <tr>
                                        <td>{{ $num+1 }}</td>
                                        <td>{{ $cotizacion->nombre_cliente }} {{ $cotizacion->apellido_cliente }}</td>
                                        <td>{{ $cotizacion->num_cotizacion}}</td>
                                        <td>{{ $cotizacion->fecha_emision }}</td>
                                        <td>{{ $cotizacion->estado }}</td>
                                        <td>{{ $cotizacion->pago_total }}</td>
                                        @if ($cotizacion->estado == "P" )
                                            <td>
                                                <a class='btn btn-info' href="{{ route('cotizaciones.show',  $cotizacion->num_cotizacion) }}">Detalle</a>
                                            </td>
                                        @else
                                            <td> </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section
@endsection
{{-- Fin Body --}}
{{--  --}}