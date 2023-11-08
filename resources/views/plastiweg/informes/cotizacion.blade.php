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
    <link type="text/css" href="{{ asset('public/css/informe/cotizacion.css') }}" rel="stylesheet">
</head>
{{--  --}}
{{-- Body --}}
@section('main')
<section class="appointment-area">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-auto mb-2" style="width: fit-content">
                <a href="{{route('informes')}}" class="btn btn-warning" style="float: left">volver</a>
            </div>
            <div class="col-md row-sm">
               <h3>LISTADO DE COTIZACIONES</h3> 
            </div>
        </div>
        <div class="d-md-flex justify-content-md-center">
            <div class="row">
                <div class="col-auto" style="width: fit-content">
                    <div class="row my-4">
                        <form method="POST" action="{{ route('cotizaciones.buscarcotizacion') }}">
                          @csrf
                            <div class="row">
                              <div class="col-auto" style="width: fit-content">
                                  <input class="form-control" type="text" id="num_cot" name="num_cot" maxlength="45" placeholder="Ingrese n° cotizacion" style="width: fit-content">
                              </div>
                              <div class="col-auto" style="width: fit-content">
                                  <button type="submit" class="btn btn-success" style= "float: right;">Buscar</button>
                              </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $cotizaciones->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-striped" style="width: fit-content">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>NUMERO DE COTIZACION</th>
                                        <th>FECHA DE EMISION</th>
                                        <th>ESTADO</th>
                                        <th>TOTAL</th>  
                                    </tr>
                                </thead>
                                <tbody class="table-warning table-group-divider">
                                    @foreach ($cotizaciones as $num=>$cotizacion)
                                        <tr>
                                            <td>{{ $num + 1}}</td>
                                            <td>{{ $cotizacion->num_cotizacion }}</td>
                                            <td>{{ $cotizacion->fecha_emision }}</td>
                                            @if ($cotizacion->estado == "P" )
                                                <td>Pendiente</td>
                                            @else
                                                <td>Aprobado</td>
                                            @endif
                                            <td>${{ $cotizacion->pago_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $cotizaciones->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section
@endsection
{{-- Fin Body --}}
{{--  --}}