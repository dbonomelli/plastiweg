{{-- ingresar cantidad para cotizacion, para agregar al "Carrito" --}}
@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - Ventas
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
{{--  --}}
{{-- Body --}}
@section('main')
    {{-- @auth --}}
        <div class="row ml-2">
            <div class="col-auto">
                <a href="{{ route('ventas.detalle') }}" class="btn btn-primary mt-4">VOLVER</a>
            </div>
        </div>
        
        <div class="col-10">
            <table class="table table-bordered table-striped table-dark mt-4">
                <thead class="table-info">
                    <tr>
                        <th scope="col" style="color: black">#</th>
                        <th scope="col" style="color: black">N° VENTA</th>
                        <th scope="col" style="color: black">PRODUCTO</th>
                        <th scope="col" style="color: black">CANTIDAD</th>
                        <th scope="col" style="color: black">DESCUENTO</th>
                        <th scope="col" style="color: black">VALOR</th>
                        <th scope="col" style="color: black">IVA</th>      
                        <th scope="col" style="color: black">SUBTOTAL</th>            
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="color: white">1</th>
                        <th style="color: white">1230548</th>
                        <th style="color: white">Bandeja blanca</th>
                        <th style="color: white">50</th>
                        <th style="color: white">0%</th>
                        <th style="color: white">$125.000</th>
                        <th style="color: white">10%</th>
                        <th style="color: white">$137.500</th>
                    </tr>
                </tbody>
            </table>
        </div>
        
    {{-- @endauth --}}
@endsection
{{-- Fin Body --}}
{{--  --}}
