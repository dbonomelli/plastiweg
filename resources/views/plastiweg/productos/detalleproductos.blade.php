
@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - DETALLE PRODUCTOS
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="row">
  <div class="col offset-md-1">
    <a href="{{ route('productos.inventario')}}" class="btn btn-info">VOLVER</a>
  </div>
</div>
<div class="col-md-6 offset-md-3">
  <div class="card border-primary">
    <div class="card" >
      <div class="card-header" style="background-color:#07342F">
        <h5 class="card-title"><strong>{{ $producto->nombre_producto }}</strong> </h5>
      </div>
      <div class="card-body" style="text-align: left; background-color: rgb(199, 199, 199)">
        <table class="table table-catalogo">
          <tbody class="producto">
            <tr>
              <th scope="row">Código:</th>
              <td>{{ $producto->codigo_producto }}</td>
            </tr>
            <tr>
              <th scope="row">Unidades por empaque:</th>
              <td>{{ $producto->contenido_unidades_por_empaque }}</td>
            </tr>
            <tr>
              <th scope="row">Precio por empaque:</th>
              <td>${{ $producto->precio_empaque }}</td>
            </tr>
            <tr>
              <th scope="row">Stock:</th>
              <td @if ($producto->stock_critico_empaques >= $producto->stock_empaques) style="background-color:red" @endif>{{ $producto->stock_empaques }}</td>
            </tr>
            <tr>
              <th scope="row">Stock Crítico:</th>
              <td>{{ $producto->stock_critico_empaques }}</td>
            </tr>
            <tr>
              <th scope="row">Almacenamiento:</th>
              <td>{{ $producto->lugar_almacenamiento }}</td>
            </tr>
            <tr style="height: max-content">
              <td>
                <div class="accordion accordion-flush" id="accordionFlush{{$producto->codigo_producto}}" >
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{$producto->codigo_producto}}">
                      <button class="accordion-button collapsed shadow rounded" type="button" data-bs-toggle="collapse" style="border-color: #7ea78a" 
                              data-bs-target="#flush-collapse{{$producto->codigo_producto}}" aria-expanded="false" aria-controls="flush-collapse{{$producto->codigo_producto}}">
                        Especificaciones:
                      </button>
                    </h2>
                    <div id="flush-collapse{{$producto->codigo_producto}}" class="accordion-collapse collapse" style="background-color: #a6ddb6" 
                        aria-labelledby="flush-heading{{$producto->codigo_producto}}" data-bs-parent="#accordionFlush{{$producto->codigo_producto}}">
                      <div class="accordion-body producto">{{ $producto->especificaciones }}</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer " style="background-color: rgb(184, 184, 184)">
        <div class="row">
          <div class="col">
                {{-- Boton modificar --}}
            <div class="d-flex justify-content-start  m-1">
              <form method="POST" action="{{ route('productos.edit', $producto->id_producto) }}">
                @csrf
                @method('GET')
                <button type="submit" class="btn btn-primary">MODIFICAR</button>
              </form>
            </div> 
          </div>
          <div class="col">
                {{-- botones Eliminar / Reincorporar --}}
            <div class="d-flex justify-content-end m-1">
              @if ($producto->deleted_at == null)

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal">DAR DE BAJA</button>
                {{-- <form method="POST" action="{{ route('productos.destroy', $producto->id_producto) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">DAR DE BAJA</button>
                </form> --}}
              @else
                <form method="POST" action="{{ route('productos.restore', $producto->id_producto) }}">
                  @csrf
                  <button type="submit" class="btn btn-success">REINCORPORAR</button>
                </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel" style="color: black">ELIMINAR PRODUCTO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: black">¿Desea dar de baja el producto {{ $producto->codigo_producto }}--{{ $producto->nombre_producto }}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
        <form method="POST" action="{{ route('productos.destroy', $producto->id_producto) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">DAR DE BAJA</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}

