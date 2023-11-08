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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md row-sm text-center mt-2">
                <h3>Listado de Ventas</h3>
            </div>
        </div>
        <div class="d-md-flex justify-content-md-center">
            <div class="row">
                <div class="col">
                    <div class="row my-4">
                        <div class="col">
                            <form method="POST" action="{{ route('ventas.buscar') }}">
                                @csrf
                                <div class="row">
                                  <div class="col-auto" >
                                      <input class="form-control" type="text" id="num_venta" name="num_venta" maxlength="45" placeholder="Numero de venta">
                                  </div>
                                  <div class="col">
                                      <button type="submit" class="btn btn-success" >Buscar</button>
                                  </div>
                                </div>
                              </form>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $ventas->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-striped table-hover" style="width: fit-content">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>NUMERO DE VENTA</th>
                                        <th>FECHA DE EMISION</th>
                                        <th>ESTADO</th>
                                        <th>TOTAL</th>
                                        <th>N° ORDEN DE COMPRA</th>
                                        <th>NUMERO COTIZACIÓN</th>      
                                        <th>ACCION</th>   
                                    </tr>
                                </thead>
                                <tbody class="table-warning table-group-divider">
                                    @foreach ($ventas as $num=>$venta)
                                        <tr>
                                            <th>{{ $num + 1 }}</th>
                                            @if (($venta->num_venta<99))
                                                <td>00{{ $venta ->num_venta }}</td>
                                            @else
                                               <td>{{ $venta ->num_venta }}</td> 
                                            @endif
                                            <td>{{ $venta ->fecha_emision }}</td>
                                            <td>
                                                <small>
                                                @if ($venta ->estado == 'E')
                                                    <u>Entregado</u>
                                                @else
                                                    <b>Aprobado</b>
                                                @endif
                                                </small>
                                                {{-- {{ $venta ->estado }} --}}
                                            </td>
                                            <td>{{ $venta ->pago_total }}</td>
                                            <td>{{ $venta ->numero_orden_de_compra }}</td>
                                            <td>{{ $venta ->cotizacion_num_cotizacion }}</td>
                                            <th>
                                                {{-- <a class="btn btn-success" href="{{ route('ventas.show', $venta->num_venta) }}">VER DETALLE</a> --}}
                                                <a class="btn btn-info" href="{{ route('ventas.detalle', $venta->num_venta) }}">DETALLE</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-md-flex justify-content-md-center">
                        <div class="row pagination">
                            <div class="col-auto">
                                {{ $ventas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div> 
        
    {{-- @endauth --}}
@endsection
{{-- Fin Body --}}
{{--  --}}
