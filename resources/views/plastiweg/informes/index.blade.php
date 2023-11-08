@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - informes
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="text-center mb-4">
            <h1>Informes</h1>
        </div>
    </div>
    <div class="">
        <div class="d-md-flex justify-content-md-center">
            <div class="row">
                <div class="col-auto row-sm mb-2">
                    <a href="{{ route('ventas') }}" class="btn btn-warning mr-2" >REGISTRO DE VENTAS</a>
                </div>
                <div class="col row-sm mb-2">
                    <a href="{{ route('informes.cotizaciones') }}" class="btn ml-2" style="background-color: #712CF9; color: white">REGISTRO DE COTIZACIONES</a>
                </div>
            </div>
        </div>
        <div class="d-md-flex justify-content-md-center">
            <div class="row">
                <div class="col-auto row-sm mb-2">
                    <a href="{{ route('informes.clientesFrecuentes') }}" class="btn btn-primary mr-2">CLIENTES FRECUENTES</a>
                </div>
                <div class="col-auto row-sm">
                    <a href="{{ route('informes.articuloCotizado') }}" class="btn btn-info mr-2">ARTICULOS MÁS COTIZADOS</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}