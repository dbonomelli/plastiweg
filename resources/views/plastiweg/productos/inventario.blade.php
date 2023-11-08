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
  <div class="container" >
      <div class="text-center mb-5">
        <h3>MANTENEDOR DE PRODUCTOS</h4>
      </div>
      <div class="row my-2" >
        <div class="col">
          <div class="d-flex justify-content-between">
            <a href="{{ route('productos.create') }}" class="btn btn-primary">NUEVO PRODUCTO</a>
            <a href="{{ route('ajuste') }}" class="btn btn-warning">AJUSTAR STOCK</a>
          </div>
        </div>
      </div> 
      <div class="row mb-2">
        <form method="POST" action="{{ route('inventario.buscar') }}">
          @csrf
          <div class="row ">
            <div class="col-auto" style="width: fit-content"> 
              <input class="form-control" type="text" id="nombre_producto" name="nombre_producto" 
              maxlength="60" placeholder="Ingrese nombre de producto" style="width: fit-content">
            </div>
            <div class="col">
              <button type="submit" class="btn btn-outline-info" >Buscar</button>
            </div>
          </div>
        </form>
      </div>
      <div class="row pagination" style="display: grid; place-items: center;">
        <div class="col-auto">
          {{ $productos->links() }}
        </div>
      </div>
      <div class="row mt-2" >
        @foreach ($productos as $product)
            <div class="card-deck col-lg-4 mb-3">
              <div class="card text-white border-light " >
                  <div class="card-header bg-dark "  style="height: 70px">
                    <h5 class="card-title" ><b>{{ $product->nombre_producto }}</b></h5>
                  </div>
                  <div class="card-body" >
                    <table class="table table-catalogo">
                      <tbody class="producto">
                        <tr>
                          <th scope="row">Código:</th>
                          <td>{{ $product->codigo_producto }}</td>
                        </tr>
                        <tr>
                          <td class="text-center">
                            <div class="col-6">
                              @if ( $product->nombre_imagen == null )
                              <img src="public/img/logos/comercializadora.jpg" alt="Default-Product" class="rounded mx-auto d-block mb-1 img-fluid" style="height: 90px">
                            @else
                              <img src="public/img/productos/{{$product->nombre_imagen}}" alt="Default-Product" class="rounded mx-auto d-block mb-1 img-fluid" style="height: 90px">
                              @endif
                            </div>
                          </div>
                        </tr>
                        <tr style="height: max-content">
                          <td>
                            <div class="accordion accordion-flush" id="accordionFlush{{$product->codigo_producto}}" >
                              <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading{{$product->codigo_producto}}">
                                  <button class="accordion-button collapsed shadow rounded" type="button" data-bs-toggle="collapse" style="border-color: #7ea78a" 
                                          data-bs-target="#flush-collapse{{$product->codigo_producto}}" aria-expanded="false" aria-controls="flush-collapse{{$product->codigo_producto}}">
                                    Especificaciones:
                                  </button>
                                </h2>
                                <div id="flush-collapse{{$product->codigo_producto}}" class="accordion-collapse collapse" style="background-color: #a6ddb6" 
                                    aria-labelledby="flush-heading{{$product->codigo_producto}}" data-bs-parent="#accordionFlush{{$product->codigo_producto}}">
                                  <div class="accordion-body producto">
                                    <table  class="table table-catalogo">
                                      <tbody class="producto">
                                        <tr>
                                          <th scope="row">Unidades por empaque:</th>
                                          <td>{{ $product->contenido_unidades_por_empaque }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Precio por empaque:</th>
                                          <td>${{ $product->precio_empaque }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Stock:</th>
                                          <td @if ($product->stock_critico_empaques >= $product->stock_empaques) style="background-color:red" @endif>{{ $product->stock_empaques }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Stock Crítico:</th>
                                          <td>{{ $product->stock_critico_empaques }}</td>
                                        </tr>
                                        <tr>
                                          <th scope="row">Descripción</th>
                                          <td>{{ $product->especificaciones }}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    @if ($product->deleted_at == null)
                        <a href="{{ route('productos.show', $product->id_producto) }}" class="btn btn-primary">Detalles</a> 
                    @endif
                    @if ($product->deleted_at != null)
                          <form method="POST" action="{{ route('productos.restore', $product->id_producto) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">REINCORPORAR</button>
                          </form>
                    @endif
                  </div>
              </div>
            </div>  
        @endforeach
      </div>
      <div class="row pagination justify-content-center">
        <div class="col-auto">
          {{ $productos->links() }}
        </div>
      </div>
  </div>
@endsection
{{-- Fin Body --}}
{{--  --}}