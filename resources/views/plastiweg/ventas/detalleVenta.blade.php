@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - DETALLE VENTAS
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-auto">
          <a href="{{ route('ventas')}}" class="btn btn-warning">VOLVER</a>
        </div>
        <div class="col-md row-sm text-center mt-2">
          <h3>Detalle venta</h3>
        </div>
  </div>
  <div class="d-md-flex justify-content-md-center">
    <div class="row">
      <div class="col-auto" style="width: fit-content">
          <div class="card border-primary" style="background-color: #237257" style="width: fit-content">
              <div class="card-header" style="background-color: rgb(30, 155, 155)">
                <h5 class="card-title"><strong>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</strong> </h5>
              </div>
              <div class="card-header">
                <h5 class="card-title"><strong>N° de Venta: {{ $venta->num_venta }}</strong> </h5>
              </div>
              <div class="card-body" style="text-align: left; background-color: #2f613c">
                <p class="card-text">FECHA DE EMISION: <b>{{ $venta ->fecha_emision }}</b> <br>
                      N° Orden de Compra: <b>{{ $venta->numero_orden_de_compra }}</b> <br>
                      N° Cotización: <b>{{ $venta->cotizacion_num_cotizacion }}</b> <br>
                      @if ($venta->forma_pago == 1)
                        Forma de Pago: <b>Boleta</b> <br>
                      @else
                        Forma de Pago: <b>Factura</b><br>
                      @endif
                      Unidad de compra: <b>Bienes y Servicios</b> <br>
                      @if ($venta->metodo_despacho == 1)
                        Método de Despacho: <b>Envío</b><br>
                      @else
                        Método de Despacho: <b>Despacho</b><br>
                      @endif
                      Cargo por envío: <b>${{ $venta ->cargo }}</b><br>
                      Estado: <b>
                          @if ($venta ->estado == 'E')
                              Entregado
                          @else
                              Aprobado
                          @endif
                        {{-- {{ $venta ->estado }} --}}
                      </b><br>
                      Descuento total: <b>{{ $venta ->descuento_total }}</b><br>
                      Valor total: <b>${{ $venta ->valor_total }}</b><br>
                      IVA total: <b>{{ $venta ->iva_total }}</b><br>
                </p>
                <p class="card-text">Total a Pagar: <b>{{ $venta ->pago_total }}</b></p>
                @if ( $venta->estado == "A")
                  <form method="POST" action="{{ route('ventas.update', $venta->num_venta) }}">
                    @csrf
                    @method('PUT')
                    <div class="float-left">
                      <button type="submit" class="btn btn-primary">Entregado</button>
                    </div>
                  </form>
                @endif
              </div>
          </div>
      </div> 
      <div class="col">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover caption-top mt-4" style="width: fit-content">
            <caption style="color: #8ec84b">Productos comprados</caption>  
            <thead style="background-color: #237257; color: white">
                  <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>descuento</th>
                      <th>Subtotal</th>                 
                  </tr>
              </thead>
              <tbody class="table-warning">
                @foreach ($productos as $num=>$producto )
                  <tr>
                    <td>{{ $num +1 }}</td>
                    <td>{{ $producto->nombre_producto }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>{{ $producto->descuento }}</td>
                    <td>{{ $producto->subtotal }}</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row my-3">
    <div class="col offset-md-3">
      <form method="POST" action=" {{ route('ventas.export') }}">
        @csrf
        <input type="text" name="num_venta" value="{{$venta->num_venta}}" hidden>
        <button type="submit" class="btn btn-info">Descargar Venta</button>
      </form>
    </div>
  </div>
</div>



@endsection
{{-- Fin Body --}}
{{--  --}}

