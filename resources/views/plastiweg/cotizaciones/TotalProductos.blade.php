
@extends('layout.master')
{{--  --}}
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/public/css/cotizacion.css') }}"/>

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - Cotizacion
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
<head>
    <link type="text/css" href="{{ asset('public/css/cotizacion/totalProductos.css') }}" rel="stylesheet">
</head>
@section('main')
<div class="stepper-conf">
  <div class="init-step"></div>
  <div class="cont-steps">
    <!-- Step1 -->
    <div class="step">
      <div class="step-icon">
        <i>1</i>
      </div>
      <div class="label-step">
        Selección
      </div>
    </div>

    <!-- Step2 -->
    <div class="step">
      <div class="step-icon">
        <i>2</i>
      </div>
      <div class="label-step">
        Cliente
      </div>
    </div>

    <!-- Step3 -->
    <div class="step active">
      <div class="step-icon">
        <i>3</i>
      </div>
      <div class="label-step">
        Confirmación
      </div>
    </div>
  </div>
</div>

<section class="appointment-area">
  <div class="container-fluid">
    <div class="appointment-here-form" style="justify-content: center;">	
        <div class="row text-center">
            <h3>EMISION DE COTIZACION</h3>
        </div>	
        <div class="d-flex justify-content-center">
            <div class="row" style="width: 50%;">
                <div class="col">
                    <p style="color:#3BC1CD">
                        <small>
                            Si desea hacer alguna modificación antes de emitir el documento, puede volver atrás y corregir lo que usted necesite.
                        </small>
                    </p>
                    <p style="color:#319ba5">
                        <small>
                           <b style="background-color: rgba(247, 4, 4, 0.842); color: rgb(27, 27, 27)">Recuerde</b> descargar la cotizacion pinchando en el botón "Descargar Cotizacion", con ello se generará la 
                          cotizacion con la información que se muestra.
                        </small>
                    </p>
                </div>
            </div>  
        </div>			
        <div class="d-flex justify-content-center">
            <div class="row" style="width: fit-content">
                <div class="col" style="width: fit-content">
                    <form method="POST" action="{{ route('cotizaciones.volver') }}">
                        @csrf
                        <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacion}} readonly="readonly" hidden= "true">
                        <button type="submit" id="btnExport" name="export" value="export to excel" class="btn btn-warning">Volver</button>
                    </form>
                    <div class="card" style="width: fit-content">
                        <div style="text-align: center;text-align: -webkit-center;">
                            <div class="col col-md-7" style="color: black">
                                <div class="card-body">
                                    <div >
                                        <h5 class="card-title font-size-22 font-weight-bold mt-2 mb-0">N° Cotización: {{$cotizacion}}</h5>
                                        <h5 class="card-title font-size-22 font-weight-bold mt-2 mb-0"><small> Señor(es) o Empresa: {{$nombre_cliente}} </small>
                                        </h5>
                                        <div class="data-atencion">
                                            <div class="card-text">
                                                <span>Fecha: {{$fecha}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caja-vendor">
                            <div class="header-caja-vendor">
                                <img alt="" class="logo-vendor" src="#">
                            </div>
                            <div class="table-responsive pharmacy-table px-4 py-2">
                                <table class="table table-bordered table-striped-columns">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Articulos</th>
                                            <th>Cantidad</th>
                                            <th>Precio empaque</th>
                                            <th style="text-align: right;">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-warning table-group-divider">
                                        @foreach ($detalle as $num=>$detalle )
                                        <tr>
                                            <td>{{ $num+1 }}</td>
                                            <td>{{ $detalle->nombre_producto }}</td>
                                            <td>{{ $detalle->cantidad }}</td>
                                            <td>{{ $detalle->precio_empaque }}</td>
                                            <td>{{ $detalle->subtotal }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody class="table-light table-group-divider" style="border-top-width: 0.07em; border-top-color: rgb(247, 174, 150)">
                                        <tr class="total-drugs">
                                            <td colspan="3"></td>
                                            <td style="text-align: right"><span>Neto</span></td>
                                            <td class="total-valor">{{$valor_total}}</td>
                                        </tr>
                                        <tr class="total-drugs">
                                            <td colspan="3"></td>
                                            <td style="text-align: right"><span>Iva</span></td>
                                            <td class="total-valor">{{$iva_total}}</td>
                                        </tr>
                                        <tr class="total-drugs" style="border-top-width: 0.1em; border-top-color: black">
                                            <td colspan="4" style="text-align: right"><span> <b>Total:</b> </span></td>
                                            <td class="total-valor"><b>{{$pago_total}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <form method="POST" action="{{ route('cotizaciones.export') }}">
                                            @csrf
                                            <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacion}} readonly="readonly" hidden= "true">
                                            <button type="submit" id="btnExport" name="export" value="export to excel" class="btn btn-primary">Descargar cotizacion</button>
                                        </form>
                                    </div>
                                    <div>
                                        <a href="{{ route("cotizaciones") }}" class="btn btn-success" style="height: fit-content;">Continuar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
              </div>
          </div>
    </div>
  </div>
</section>

@endsection
{{-- Fin Body --}}