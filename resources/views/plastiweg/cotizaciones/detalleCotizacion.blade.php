
@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - DETALLE COTIZACION
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="container mb-2">
  <div class="row mb-2">
    <div class="col-auto">
      <a href="{{ route('cotizaciones.consulta')}}" class="btn btn-warning">VOLVER</a>
    </div>
  </div>
   <div class="row justify-content-center">
    <div class="col-auto">
      <div class="row ">
        <div class="col ">
            <form method="POST" action="{{ route('ventas.rechazar') }}">
                @csrf
                <input class="form-control" type="text" id="num_cotizacion" name="num_cotizacion" value={{$cotizacion->num_cotizacion}} readonly="readonly" hidden= "true">
                <button type="button" class='btn btn-outline-danger btn-small' data-bs-toggle="modal" data-bs-target="#confirmModal">Rechazar</button>
                
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: rgb(250, 85, 19)">
                        <h5 class="modal-title" id="confirmModalLabel" style="color: rgb(255, 255, 255)">¿Desea rechazar esta cotización?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      {{-- <div class="modal-body" style="background-color: rgba(205, 247, 188, 0.432)">
                        <p style="color: black; font-size: larger; font-weight: 500"> ¿Desea rechazar esta cotización?</p>
                      </div> --}}
                      <div class="modal-footer" style="background-color: rgba(211, 245, 197, 0.432)">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-outline-danger">Aceptar</button>
                      </div>
                    </div>
                  </div>
              </div>
            </form>
        </div>
        <div class="col">
            <form method="POST" action="{{ route('ventas.aceptar') }}">
                @csrf
                <input class="form-control" type="text" id="num_cotizacion" name="num_cotizacion" value={{$cotizacion->num_cotizacion}} readonly="readonly" hidden= "true">
                <button type="button" class='btn btn-primary btn-small' data-bs-toggle="modal" data-bs-target="#confirmModalAceptar">Aceptar</button>
                
                <div class="modal fade" id="confirmModalAceptar" tabindex="-1" aria-labelledby="confirmModalAceptarLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: rgb(148, 224, 117)">
                        <h5 class="modal-title" id="confirmModalAceptarLabel" style="color: black">¿Desea aceptar esta cotización?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      {{-- <div class="modal-body" style="background-color: rgba(184, 238, 162, 0.432)">
                        <p style="color: black; font-size: larger; font-weight: 500"> ¿Desea aceptar esta cotización?</p>
                      </div> --}}
                      <div class="modal-footer" style="background-color: rgba(184, 238, 162, 0.432)">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-outline-success">Aceptar</button>
                      </div>
                    </div>
                  </div>
              </div>
            </form>
        </div>
    </div>
    </div>
  </div>
  <div class="row justify-content-evenly">
    <div class="col-auto" style="width: fit-content">
        <div class="card border-primary" style="width: fit-content">
            <div class="card" style="background-color:#06695e">
                <div class="card-header">
                  <h5 class="card-title"><strong>N° de Cotizacion: {{ $cotizacion->num_cotizacion }}</strong> </h5>
                </div>
                <div class="card-body" style="text-align: left">
                  <p class="card-text">FECHA DE EMISION: <b>{{ $cotizacion ->fecha_emision }}</b> <br>
      

                    Unidad de compra: <b>Bienes y Servicios</b> <br>
      
                    Estado: <b>
                              @if ($cotizacion ->estado == 'P')
                                  Pendiente
                              @else
                                  Aprobado
                              @endif
                              </b><br>
                    Descuento total: <b>{{ $cotizacion ->descuento_total }}</b><br>
                    Valor total: <b>${{ $cotizacion ->valor_total }}</b><br>
                    IVA total: <b>{{ $cotizacion ->iva_total }}</b><br>
                    
                  </p>
                  <p class="card-text">Total a Pagar: <b>{{ $cotizacion ->pago_total }}</b></p>
                  @if ( $cotizacion->estado == "A")
                    <form method="POST" action="{{ route('cotizacions.update', $cotizacion->num_cotizacion) }}">
                      @csrf
                      @method('PUT')
                      <div class="float-left">
                        <button type="submit" class="btn btn-success">Entregado</button>
                      </div>
                    </form>
                  @endif
                </div>
            </div>
        </div>
    </div> 
    <div class="col-auto">
      <div class="table-responsive-md d-md-flex justify-content-md-center">
        <table class="table table-bordered table-striped table-dark mt-4" style="width: fit-content">
          <thead class="table-info">
              <tr>
                  <th scope="col" style="color: black">#</th>
                  <th scope="col" style="color: black">Producto</th>
                  <th scope="col" style="color: black">Cantidad</th>
                  <th scope="col" style="color: black">descuento</th>
                  <th scope="col" style="color: black">Subtotal</th>                 
              </tr>
          </thead>
          <tbody>
            @foreach ($productos as $num=>$producto )
              <tr>
                <td>{{ $num +1 }}</td>
                <td>{{ $producto->nombre_producto }}</td>
                <td>{{ $producto->cantidad }}</td>
                <td>{{ $producto->descuento }}%</td>
                <td>{{ $producto->subtotal }}</td>
              </tr>
            @endforeach
          </tbody>
      </table>
      </div>
    </div>
  </div>
  <div class="row my-3 offset-1">
    <div class="col offset-2">
      <form method="POST" action=" {{ route('cotizaciones.export') }}">
        @csrf
        <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{ $cotizacion->num_cotizacion }} readonly="readonly" hidden= "true">
        <button type="submit" class="btn btn-info">Descargar cotizacion</button>
      </form>
    </div>
  </div>
</div>

@endsection
{{-- Fin Body --}}
{{--  --}}

