@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - Clientes
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<section class="appointment-area">
    <div class="container-fluid">
        <div class="d-flex justify-content-start my-2">
            <a href="{{ route('vendedor.lista') }}" class="btn btn-warning">Cancelar</a>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row" style="width: fit-content">
                <h2>Detalle Vendedor</h2>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row" style="width: fit-content">
                <div class="col-auto offset-md-2" style="width: fit-content">
                    <label>Nombre *</label>
                    <div class="form-group">
                        <input type="text" style="color: white" name="nombre" id="nombre" disabled placeholder="nombre vendedor" value="{{ $vendedor->nombre_vendedor }}">
                    </div>
                    <label>Usuario *</label>
                    <div class="form-group">
                        <input type="text" style="color: white" name="usuario" id="usuario" disabled placeholder="usuario" value="{{ $vendedor->usuario }}">
                    </div>
                </div>
                <div class="col-auto" style="width: fit-content">
                    <label>Apellido *</label>
                    <div class="form-group">
                        <input type="text" style="color: white" name="apellido" id="apellido" disabled placeholder="apellido vendedor" value="{{ $vendedor->apellido_vendedor }}">
                    </div>
                    <label>Contrasena *</label>
                    <div class="form-group">
                        <input type="text" style="color: white" name="contrasena" id="contrasena" disabled placeholder="constraseña" value="{{ $vendedor->contrasena }}">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="d-flex justify-content-around">
                        <a href="{{ route('vendedor.edit', $vendedor->id_vendedor) }}" class="btn btn-primary">Editar</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal">ELIMINAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel" style="color: black">ELIMINAR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: black">¿Desea eliminar al vendedor {{$vendedor->usuario}}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
        <form method="POST" action="{{ route('vendedor.destroy', $vendedor->id_vendedor) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">ELIMINAR</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
{{-- Fin Body --}}
