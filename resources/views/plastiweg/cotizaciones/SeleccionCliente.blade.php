@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - cotizacion
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
<head>
  <link type="text/css" href="{{ asset('public/css/cotizacion/seleccionCliente.css') }}" rel="stylesheet">
</head>

@section('main')
<div class="container-fluid">
  <div class="row mb-3" style="width: fit-content">
    <a class="btn btn-warning" href="{{ route('cotizaciones') }}">Volver</a>
  </div>
</div>
<div class="container-fluid">
  <div class="stepper-conf">
      <div class="init-step"></div>
      <div class="cont-steps">
        <!-- Step1 -->
        <div class="step active">
          <div class="step-icon">
            <i>1</i>
          </div>
          <div class="label-step">
            Cliente
          </div>
        </div>
        <!-- Step2 -->
        <div class="step">
          <div class="step-icon">
            <i>2</i>
          </div>
          <div class="label-step">
            Productos
          </div>
        </div>
        <!-- Step3 -->
        <div class="step">
          <div class="step-icon">
            <i>3</i>
          </div>
          <div class="label-step">
            Confirmación
          </div>
        </div>
      </div>
  </div>
</div>

<div class="container-fluid">
    <div class="d-md-flex justify-content-md-center">
        <div class="row">
            <div class="col-auto mb-3" style="width: fit-content">
              <div>
                <h5 style="width: fit-content">Elegir Cliente</h5>
              </div>
              <div style="width: fit-content">
                <form action="{{ route('cotizaciones.store') }}" method="POST" enctype="multipart/form-data">     
                  @csrf
                  <div class="form-group">
                      <select class="form-control" id='cliente' name='cliente' required >
                          <option value="">--</option>
                          @foreach ( $clientes as $cliente)
                            @if ($cliente->deleted_at == null)
                              <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_cliente }} - {{ $cliente->apellido_cliente  }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary"> Continuar</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-md row-sm ml-3">
              <div>
                <h5>Nuevo cliente</h5>
              </div>
              <div>
                <a href="{{ route("cliente.create") }}" class='btn btn-warning'>Registrar</a>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}
