@extends('layout.master')

{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG-INVENTARIO
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="menu">
    <h1>Este producto ya existe en el inventario</h1>
    <h1>¿Qué quieres hacer?</h1>
    <br>
    <div class="row w-100 align-items-center" >
        <div class="col text-center">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <a href="{{ route('productos.inventario') }}" class="btn btn-success mr-2" >Cancelar</a>
                <a href="{{ route('productos.create') }}" class="btn btn-success mr-2" >Modificar</a>
            </div> 
        </div>       
    </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}