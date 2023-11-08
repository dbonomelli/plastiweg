
@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - INFORMES
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
{{--  --}}
{{-- Body --}}
@section('main')
    <div class="container-fluid">
        <div class="row text-center">
            <h3>ARTICULOS MÁS COTIZADOS</h3>
            <p>Listado de los principales 5 productos más vendidos</p>
        </div>
        <div class="row ml-2">
            <div class="col-auto">
                <a href="{{ route('informes') }}" class="btn btn-warning mt-2">VOLVER</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-4" style="width: fit-content">
                            <thead class="table-info">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO PRODUCTO</th>
                                    <th>NOMBRE PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>STOCK</th>
                                    <th>EMPAQUES VENDIDOS</th>           
                                </tr>
                            </thead>
                            <tbody class="table-warning">
                                @foreach ($productos as $num=>$producto)
                                    <tr>
                                        <th style="font-size: medium; font-weight: normal">{{ $num + 1 }}</th>
                                        <th style="font-size: medium; font-weight: normal">{{ $producto->codigo_producto}}</th>
                                        <th style="font-size: medium; font-weight: normal">{{ $producto->nombre_producto}}</th>
                                        <th style="font-size: medium; font-weight: normal">${{ $producto->precio_empaque}}.</th>
                                        <th style="font-size: medium; font-weight: normal">{{ $producto->stock_empaques}}</th>
                                        <th style="font-size: medium; font-weight: normal">{{ $producto->vendido}}</th>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Fin Body --}}
{{--  --}}
