@extends('layout.master')
{{--  --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/> --}}

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - Clientes
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-auto mb-3" style="width: fit-content">
            <a href="{{ route("cotizaciones.seguir") }}"  class="btn btn-warning">Cancelar</a>
        </div>
    </div>
    <div class="d-md-flex justify-content-md-center">
        <div class="row">
            <h2>Confirmacion de datos del cliente</h2>
        </div>
    </div>
    <div class="d-md-flex justify-content-md-center">
        
        <div class="row">
            <div class="col-md row-sm">
                <div><label style="font-size: small; color:#3BC1CD">N° cotizacion: <label style="font-size: medium; color: white">{{$cotizacion}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Rut: <label style="font-size: medium; color: white">{{$cliente->rut}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Cliente: <label style="font-size: medium; color: white">{{$cliente->nombre_cliente}} {{$cliente->apellido_cliente}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Teléfono: <label style="font-size: medium; color: white">{{$cliente->telefono_contacto_cliente}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Email: <label style="font-size: medium; color: white">{{$cliente->correo}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Direccion: <label style="font-size: medium; color: white">{{$cliente->direccion_cliente}}</label></label></label></div>
                <div><label>{{$region}}, {{$comuna}}.</label></div>
                
            </div>
            <div class="col-md row-sm">
                <div><label style="font-size: small; color:#3BC1CD">Nombre recepcionista: <label style="font-size: medium; color: white">{{$cliente->nombre_pers_contacto}}</label> </label></div>
                <div><label style="font-size: small; color:#3BC1CD">Telefono recepcionista: <label style="font-size: medium; color: white">{{$cliente->telefono_pers_contacto}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Direccion despacho: <label style="font-size: medium; color: white">{{$cliente->direccion_despacho}}</label></label></div>
                <div><label style="font-size: small; color:#3BC1CD">Direccion orden de compra: <label style="font-size: medium; color: white"></label> {{$cliente->direccion_entrega_od}}</label></div>
            </div>
        </div>
    </div>
    <br>
    <div class="d-md-flex justify-content-md-center">
        <div class="row" style="width: fit-content">
            <hr>
            <p style="color:#3BC1CD">* Campos obligatorios</p>
        </div>
    </div>
    <div class="d-md-flex justify-content-md-center mt-3">
        <div class="row">
            <form action="{{route('ventas.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" max="50" name="cotizacion" id="cotizacion" value={{$cotizacion}} style='visibility: hidden;'>
                <input type="text" max="50" name="cliente" id="cliente" value={{$cliente->id_cliente}} style='visibility: hidden;'>
                <div class="row">
                    <div class="col">
                        <div>
                            <label>Metodo envio *</label>
                            <select class="form-control" id='despacho' name='despacho' required>
                                <option value="1" selected>Despacho</option>
                                <option value="2" >Envio</option>
                            </select>
                        </div>
                        <div>
                            <label>Forma de pago *</label>
                            <select class="form-control" id='pago' name='pago' required>
                              <option value="1">efectivo</option>
                              <option value="2" selected>transferencia</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <label>Costo de despacho *</label>
                            <input type="number" maxlength="6" name="cargo" id="cargo" value=0 max=999999
                            oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
                        </div>
                        <div>
                            <label>Numero orden de compra *</label>
                            <input type="text" max="" name="od" id="od" value=''  required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Continuar</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: rgb(148, 224, 117)">
                          <h5 class="modal-title" id="confirmModalLabel" style="color: black">Confirmacion de venta</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: rgba(184, 238, 162, 0.432)">
                          <p style="color: black; font-size: larger; font-weight: 500"> ¿Desea aprobar la cotización n° {{$cotizacion}} de {{$cliente->nombre_cliente}} {{$cliente->apellido_cliente}}?</p>
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
@endsection

{{-- Fin Body --}}
