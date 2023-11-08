@extends('layout.master')

{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
plastiweb - productos
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
    <div class="container-fluid" >
      <div class="text-center" >
        <h3>CATALOGO DE PRODUCTOS</h3>
      </div>
      <div class="row my-4">
        <div class="col offset-1">
          <form method="POST" action="{{ route('catalogo.buscar') }}">
            @csrf
            <div class="row ">
              <div class="col-auto" >
                <input class="form-control" type="text" id="nombre_producto" name="nombre_producto" 
                maxlength="60" placeholder="Ingrese nombre de producto" style="width: 20em">
              </div>
              <div class="col">
                <button type="submit" class="btn btn-outline-success" >Buscar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col d-flex justify-content-evenly offset-1">
          <a href="{{ route('productos.inventario') }}" class="btn btn-info" style="float: right;">INVENTARIO</a>
        </div>
      </div>
      <div class="row offset-1 mt-4" >
        @foreach ($productos as $product)
            <div class="card-deck col-lg-5 mb-3">
              <div class="card text-white border-light " >
                  <div class="card-header bg-dark " >
                    <h5 class="card-title" ><b>{{ $product->nombre_producto }}</b></h5>
                  </div>
                  <div class="card-body bgCard" >
                    <table class="table table-catalogo">
                      <tbody class="producto">
                        <tr>
                          <th scope="row">Código:</th>
                          <td>{{ $product->codigo_producto }}</td>
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
                                  <div class="accordion-body producto">{{ $product->especificaciones }}</div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Unidades por empaque:</th>
                          <td>{{ $product->contenido_unidades_por_empaque }}</td>
                        </tr>
                        <tr>
                          <th scope="row">Precio por empaque:</th>
                          <td>${{ $product->precio_empaque }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>  
        @endforeach
      </div>
      <div class="row pagination justify-content-center">
        {{ $productos->links() }}
      </div>
    </div>
@endsection
{{-- Fin Body --}}
{{--  --}}
