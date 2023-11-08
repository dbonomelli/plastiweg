@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - FACTURACIÓN
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
{{-- Body --}}
@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row mb-3">
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('facturas') }}" class="btn btn-warning" style="width: fit-content">Volver</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="d-md-flex justify-content-md-center">
        
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('facturas.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg col-sm-6">
                            <label>N° de FACTURA *</label>
                            <div class="form-group">
                                <input type="text" name="nroFactura" id="nroFactura" class="form-control" required data-error="* Ingresa nroFactura"
                                    @if (isset($_GET['factura'])) value="{{ $_GET['factura'] }}" @endif>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-sm-6">
                            <label>N° de Venta asociada *</label>
                            <div class="form-group">
                                <input type="number" name="nroVenta" id="nroVenta" class="form-control" required data-error="* Ingresa numero de venta" 
                                 @if (isset($_GET['venta'])) value="{{ $_GET['venta'] }}" @endif onchange="ingresoVenta(this.value)">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-sm-6">
                            <label>Cliente *</label>
                            <div class="form-group">
                                <select class="form-control" id='cliente' name='cliente' required  @readonly(true) style="background-color: rgb(187, 187, 187)">
                                    <option value="">--</option>
                                    @foreach ( $clientes as $cliente)
                                        @if ($cliente->deleted_at == null)
                                            @if (isset($_GET['venta']))
                                                @foreach ($ventas as $venta)
                                                    @if ($venta->num_venta == $_GET['venta'])
                                                        <option value="{{ $cliente->id_cliente }}" selected>{{ $cliente->nombre_cliente }} - {{ $cliente->apellido_cliente  }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_cliente }} - {{ $cliente->apellido_cliente  }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-sm-6">
                            <label>Monto Total a pagar *</label>
                            <div class="form-group">
                                <input type="number" name="montoTotal" id="montoTotal" class="form-control" required style="background-color: rgb(187, 187, 187)"
                                    readonly
                                    @if (isset($_GET['venta']))
                                        @foreach ($ventas as $venta)
                                            @if ($venta->num_venta == $_GET['venta'])
                                               value="{{ $venta->pago_total }}"
                                            @endif
                                        @endforeach
                                    @else
                                        value="0"
                                    @endif
                                     >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-sm-6">
                            <label>Pago a realizar</label>
                            <div class="form-group">
                                <input type="number" name="pagoRealizar" id="pagoRealizar" class="form-control" required data-error="* Ingresa pagoRealizar"
                                @if (isset($_GET['pago'])) value="{{ $_GET['pago'] }}" @else value="0" @endif min="0">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal">Guardar</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(148, 224, 117)">
                              <h5 class="modal-title" id="confirmModalLabel" style="color: black">¿Desea crear este registro de factura?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
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
    <script>

        function ingresoVenta(valor){
            // location.href='?venta='+valor+'&factura='+$('#nroFactura').val()+'&monto='+$('#montoTotal').val()+'&pago='+ $('#pagoRealizar').val();
            let datos = "";
            if (document.getElementById("nroFactura").value != null) {
                datos = datos + '&factura='+ document.getElementById("nroFactura").value;
            }
            if (document.getElementById("montoTotal").value != null) {
                datos = datos + '&monto='+ document.getElementById("montoTotal").value;
            }
            if (document.getElementById("pagoRealizar").value != null) {
                datos = datos + '&pago='+ document.getElementById("pagoRealizar").value ;
            }
            location.href='?venta='+valor + datos;
        }

    </script>
</div> 
@endsection
{{-- Fin Body --}}
{{--  --}}
