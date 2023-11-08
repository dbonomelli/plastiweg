
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
            <a href="{{ route('vendedor.show', $vendedor->id_vendedor) }}" class="btn btn-warning">
                Cancelar
            </a>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row" style="width: fit-content">
                <h2>Editar Vendedor</h2>
                <p style="color:#3BC1CD">* Campo obligatorio</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="appointment-here-form d-flex justify-content-center">
                    <div class="contact-wrap contact-pages">
                        <form method="POST" action="{{ route ('vendedor.update', $vendedor->id_vendedor) }}">
                            @csrf
                            @method('PUT')
                            <div class="row" style="width: fit-content">
                                <div class="col-auto">
                                    <label>Nombre *</label>
                                    <div class="form-group mb-2">
                                        <input type="text" name="nombre" id="nombre" class="form-control" required data-error="* Ingresa nombre" placeholder="nombre vendedor" value="{{ $vendedor->nombre_vendedor }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <label>Usuario *</label>
                                    <div class="form-group">
                                        <input type="text" name="usuario" id="usuario" class="form-control" required data-error="* Ingrese usuario" placeholder="usuario" value="{{ $vendedor->usuario }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label>Apellido *</label>
                                    <div class="form-group mb-2">
                                        <input type="text" name="apellido" id="apellido" class="form-control" required data-error="* Ingresa apellido" placeholder="apellido vendedor" value="{{ $vendedor->apellido_vendedor }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <label>Nueva Contrasena *</label>
                                    <div class="form-group">
                                        <input type="text" name="password" id="password" class="form-control" required data-error="* Ingresa contraseña" placeholder="constraseña" value="{{ $vendedor->contrasena }}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
{{-- Fin Body --}}
