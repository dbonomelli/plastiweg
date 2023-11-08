@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - VENDEDOR
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
<head>
    <link type="text/css" href="{{ asset('public/css/vendedores/create.css') }}" rel="stylesheet">
</head>
{{--  --}}
{{-- Body --}}
@section('main')
<section class="appointment-area">
    <div class="container-fluid">
        <div class="row text-center mb-4">
            <div class="col-auto">
                <a href="{{ route('vendedor.lista') }}" class="btn btn-warning">Cancelar</a>
            </div>
            <div class="col">
                <h2>Ingrese Nuevo Vendedor</h2>
                <p style="color:#3BC1CD">* Campo obligatorio</p>
            </div>
          </div>
        <div class="row">
            <div class="col">
                <div class="appointment-here-form">
                    <div class="d-flex justify-content-center">
                        <div class="contact-form">
                            <form method="POST" action="{{ route ('vendedor.store') }}">
                                @csrf
                                <div class="row" style="width: fit-content">
                                    <div class="col">
                                        <label>Nombre *</label>
                                        <div class="form-group">
                                            <input type="text" max="45" name="nombre" id="nombre" class="form-control" 
                                                required data-error="* Ingrese nombre" placeholder="Nombre vendedor">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <label>Usuario *</label>
                                        <div class="form-group">
                                            <input type="text" max="45" name="usuario" id="usuario" class="form-control" required data-error="Ingresar nuevo usuario" placeholder="Usuario de vendedor">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Apellido *</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="apellido" id="apellido" class="form-control" 
                                                required data-error="* Ingrese apellido" placeholder="Apellido vendedor">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <label>Contrasena *</label>
                                        <div class="form-group">
                                            <input type="text" max="150" name="password" id="password" class="form-control" required data-error="Ingresar contraseña" placeholder="Contraseña del usuario">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
{{-- Fin Body --}}
