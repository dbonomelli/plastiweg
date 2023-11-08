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
        <div class="d-md-flex justify-content-md-center">
        
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('facturas.update', $facturaEdit->id_factura) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg col-sm-6">
                                <label>N° de FACTURA *</label>
                                <div class="form-group">
                                    <input type="text" name="nroFactura" id="nroFactura" class="form-control" value="{{ $facturaEdit->num_factura }}" readonly style="background-color: rgb(187, 187, 187)">
                                </div>
                            </div>
                            <div class="col-lg col-sm-6">
                                <label>N° de Venta asociada *</label>
                                <div class="form-group">
                                    <input type="number" name="nroVenta" id="nroVenta" class="form-control" value="{{ $facturaEdit->venta_num_venta }}" readonly style="background-color: rgb(187, 187, 187)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg col-sm-6">
                                <label>Cliente *</label>
                                <div class="form-group">
                                    <input type="text" name="cliente" id="cliente" class="form-control" value="{{ $facturaEdit->nombre_cliente }} - {{ $facturaEdit->apellido_cliente  }}" readonly style="background-color: rgb(187, 187, 187)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg col-sm-6">
                                <label>Monto Total a pagar *</label>
                                <div class="form-group">
                                    <input type="number" name="montoTotal" id="montoTotal" class="form-control" 
                                        style="background-color: rgb(187, 187, 187)" value="{{ $facturaEdit->monto_total }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg col-sm-6">
                                <label>Pago a realizar</label>
                                <div class="form-group">
                                    <input type="number" name="pagoRealizar" id="pagoRealizar" class="form-control" required data-error="* Ingresa pagoRealizar"
                                     min="0">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
    
    
                        <div class="row mt-3">
                            <div class="col">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal">Agregar Pago</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: rgb(148, 224, 117)">
                                  <h5 class="modal-title" id="confirmModalLabel" style="color: black">¿Agregar registro del pago?</h5>
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
    </div>
</div> 
@endsection
{{-- Fin Body --}}
{{--  --}}
