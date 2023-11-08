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
    <link type="text/css" href="{{ asset('public/css/cotizacion/consultar.css') }}" rel="stylesheet">
</head>
{{--  --}}
{{-- Body --}}
@section('main')
<section class="">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-ato" style="width: fit-content">
                <a href="{{route('cotizaciones')}}" class="btn btn-warning" style="font-size: 13pt">volver</a>
            </div>
            <div class="col">
                <h3>CONSULTA COTIZACIONES</h3>
            </div>
        </div>
        <div class="row mt-4">
            <form method="POST" action="{{ route('cotizaciones.buscar') }}">
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
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-bordered border-info table-hover" style="width: fit-content">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Numero de cotizacion</th>
                                    <th>Fecha de emision</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody class="table-warning">
                                @foreach ($cotizaciones as $num=>$cotizacion)
                                    <tr>
                                        <td>{{ $num+1 }}</td>
                                        <td>{{ $cotizacion->nombre_cliente }} {{ $cotizacion->apellido_cliente }}</td>
                                        <td>{{ $cotizacion->num_cotizacion}}</td>
                                        <td>{{ $cotizacion->fecha_emision }}</td>
                                        @if ($cotizacion->estado == "P" )
                                            <td>Pendiente</td>
                                        @else
                                            <td>Aprobado</td>
                                        @endif
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
        <div class="row pagination justify-content-center">
            <div class="col-auto">
              {{ $cotizaciones->links() }}
            </div>
        </div>
    </div>
</section
@endsection
{{-- Fin Body --}}
{{--  --}}