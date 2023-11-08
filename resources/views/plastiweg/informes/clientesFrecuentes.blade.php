@extends('layout.master')

{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG-INFORMES
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
    <div class="container-fluid" >
      <div class="container-fluid mt-4">
        <div class="row text-center">
            <div class="col-auto">
              <a href="{{ route('informes') }}" class="btn btn-warning mt-2">VOLVER</a>
          </div>
          <div class="col">
            <h3>CLIENTES FRECUENTES</h3>
            <p>Información de los cuatro clientes que más compran.</p>
          </div>
        </div>
      </div>
        <div class="row row-cols-1 row-cols-md-3 g-2">
          @foreach ($clientes as $cliente)
            @if ($cliente->deleted_at == null)
                <div class="col mb-1">
                  <div class="card border-primary">
                      <div class="card" style="background-color: #eff1f1">
                          <div class="card-header">
                            <h5 class="card-title" style="color: black">{{ $cliente->nombre_cliente }} {{$cliente->apellido_cliente}}</h5>
                          </div>
                          <div class="card-body">
                            <p class="card-text" style="color: black">RUT: {{$cliente->rut}}</p>
                            <p class="card-text" style="color: black">DIRECCION: {{$cliente->direccion_cliente}}</p>
                            <p class="card-text" style="color: black">TELEFONO: {{$cliente->telefono_contacto_cliente}}</p>
                            <p class="card-text" style="color: black">CORREO: {{$cliente->correo}}</p>
                          </div>
                      </div>
                  </div>
                </div>
            @endif
          @endforeach
        </div>
    </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}