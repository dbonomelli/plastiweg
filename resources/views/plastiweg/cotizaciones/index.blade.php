@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>


{{-- Titulo Pagina --}}
@section('title')
Plastiweb - cotizaciones
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="accesos">
    <div class="row mb-3">
        <h1>Bienvenido</h1>
        <h3>¿Qué quieres hacer?</h3>
    </div>
    <div class="row align-items-center" style="height: 8em">
        <div class="d-flex justify-content-md-evenly text-center mb-2">
            <div class="btn-group" role="group" aria-label="First group" style="width: fit-content">
                <a href="{{ route("cotizaciones.create") }}" style="width: fit-content" class="btn btn-primary mx-1" >Crear Cotizacion</a>
            </div> 
            <div class="btn-group" role="group" aria-label="Second group" style="width: fit-content">
                <a href="{{ route("cotizaciones.seguir") }}" style="width: fit-content" class="btn btn-success mx-1" >Seguir Cotizacion</a>
            </div> 
        </div>       
    </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}