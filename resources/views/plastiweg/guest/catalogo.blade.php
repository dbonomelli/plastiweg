@extends('layout.masterGuest')

{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
plastiweb - Catalogo
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
  @guest
    <div class="container" >
      <div class="text-center" >
        <h3>CATALOGO DE PRODUCTOS</h3>
      </div>
      <div class="row mb-2">
        <form method="POST" action="{{ route('catalogo.buscar') }}">
          @csrf
          <div class="row">
            <div class="col-auto" style="width: fit-content"> 
              <input class="form-control" type="text" id="nombre_producto" name="nombre_producto" 
              maxlength="60" placeholder="Ingrese nombre de producto" style="width: fit-content">
            </div>
            <div class="col">
              <button type="submit" class="btn btn-outline-warning" >Buscar</button>
            </div>
          </div>
        </form>
      </div>
      <div class="row pagination" style="display: grid; place-items: center;">
        <div class="col-auto">
          {{ $productos->links() }}
        </div>
      </div>
      <div class="row mt-4" >
        @foreach ($productos as $product)
            <div class="card-deck col-lg-4 mb-3">
              <div class="card text-white border-light ">
                  <div class="card-header bg-dark p-2" style="height: 70px">
                    <h5 class="card-title" ><b>{{ $product->nombre_producto }}</b></h5>
                  </div>
                  <div class="card-body bgCard" >
                    <div class="text-center">
                        <div class="col-12">
                          <img src="{{$product->imagen}}" alt="Default-Product" class="rounded mx-auto d-block mb-1 img-fluid" style="height: 90px">
                        <div>
                          <label><small style="font-size: 0.6em; color: black"><b>Imagen referencial</b></small></label>
                        </div>
                      </div>
                    </div>
                    <div class="accordion accordion-flush" id="accordionFlush{{$product->id_producto}}" >
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{$product->id_producto}}">
                          <button class="accordion-button collapsed shadow rounded" type="button" data-bs-toggle="collapse" style="border-color: #7ea78a" 
                                  data-bs-target="#flush-collapse{{$product->id_producto}}" aria-expanded="false" aria-controls="flush-collapse{{$product->codigo_producto}}">
                            Especificaciones:
                          </button>
                        </h2>
                        <div id="flush-collapse{{$product->id_producto}}" class="accordion-collapse collapse" style="background-color: #a6ddb6" 
                            aria-labelledby="flush-heading{{$product->id_producto}}" data-bs-parent="#accordionFlush{{$product->id_producto}}">
                            <table class="table table-bordered">
                              <tbody class="producto">
                                <tr style="height: max-content">
                                  <th scope="row"><label>Descripción</label></th>
                                  <td>
                                    {{ $product->especificaciones }}
                                  </td>
                                </tr>
                                <tr>
                                  <th scope="row">Unidades por empaque:</th>
                                  <td>{{ $product->contenido_unidades_por_empaque }}</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
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
  @endguest
@endsection
{{-- Fin Body --}}
{{--  --}}
