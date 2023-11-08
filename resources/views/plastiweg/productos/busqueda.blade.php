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
      <div class="row mt-2">
        <div class="col-md-auto ml-3 mb-2">
          <a href="{{ route('productos') }}" class="btn btn-warning">VOLVER</a>
        </div>
        <div class="col-md-auto">
          <a href="{{ route('productos.create') }}" class="btn btn-success">NUEVO PRODUCTO</a>
        </div>
        <div class="col-md-auto">
          <a href="{{ route('ajuste') }}" class="btn btn-success">AJUSTAR STOCK</a>
        </div>
      </div> 
      <div class="row mt-2 mb-2">
        <form method="POST" action="{{ route('inventario.buscar') }}" class="col-10">
          @csrf
          <div class="float-left col-sm-auto ">
            <input class="form-control" type="text" id="nombre_producto" name="nombre_producto" maxlength="45" 
            placeholder="Nombre de producto">
          </div>
          <div class="float-left col-sm-auto">
            <button type="submit" class="btn btn-info" >Buscar</button>
          </div>
        </form>
      </div>
      <div class="pl-3" style="background-color: #07342F; float: left;">
        <div class="row">
          @foreach ($productos as $product)
            <div class="card-deck col-sm-6 col-md-5 mb-3">
                <div class="card border-light text-white bg-dark" >
                  <div class="card-header">
                    <h5 class="card-title">{{ $product->nombre_producto }}</h5>
                  </div>
                  <div class="card-body" style="text-align: left">
                    <p class="card-text">Unidades por empaque: {{ $product->contenido_unidades_por_empaque }} unidades</p>
                    <p class="card-text">Precio por empaque: ${{ $product->precio_empaque }}</p>
                    <p class="card-text">Stock: {{ $product->stock_empaques }}</p>
                    <p class="card-text">Stock crítico: {{ $product->stock_critico_empaques }}</p>
                    <p class="card-text" style="text-justify">Especificaciones: {{ $product->especificaciones }}</p>
                    <p class="card-text">Almacenamiento: {{ $product->lugar_almacenamiento }}</p>
                    <div class="card-footer bottom">
                      <div class="row">
                        @if ($product->deleted_at == null)
                          <div class="d-flex justify-content-start p-2 m-1">
                            <form method="POST" action="{{ route('productos.edit', $product->id_producto) }}">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-info">MODIFICAR</button>
                            </form>
                          </div>                    
                        @else
                          <div class="d-flex justify-content-start p-2 m-1">
                            <a href="" class="btn btn-info">MODIFICAR</a>
                          </div>
                        @endif
                        @if ($product->deleted_at == null)
                          <div class="d-flex justify-content-end p-2 m-1">
                            <form method="POST" action="{{ route('productos.destroy', $product->id_producto) }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">DAR DE BAJA</button>
                            </form>
                          </div>                    
                        @else
                          <div class="d-flex justify-content-end p-2 m-1">
                            <form method="POST" action="{{ route('productos.restore', $product->id_producto) }}">
                              @csrf
                              <button type="submit" class="btn btn-success">REINCORPORAR</button>
                            </form>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          @endforeach
        </div>  
      </div>
    </div>
</div>
@endsection
{{-- Fin Body --}}
{{--  --}}