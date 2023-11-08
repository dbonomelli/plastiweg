@extends('layout.master')

@section('title')
Plastiweb - Cotizacion
@endsection

<head>
    <link type="text/css" href="{{ asset('css/detalleCotizacion/index.css') }}" rel="stylesheet">
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
          Cliente
        </div>
      </div>

      <!-- Step2 -->
      <div class="step active">
        <div class="step-icon">
          <i>2</i>
        </div>
        <div class="label-step">
            Seleccione
        </div>
      </div>

      <!-- Step3 -->
      <div class="step">
        <div class="step-icon">
          <i>3</i>
        </div>
        <div class="label-step">
          Confirmación
        </div>
      </div>
    </div>
</div>
@csrf
<div>
    <div class="row">
        <div class="col offset-2">
            @if ($cotizacion)
                <h5> Nº Cotizacion: {{ $cotizacion }}</h5>
                <h5> valor total: {{ $valor_total }}</h5>
            @else
                <?php 
                    $cotizacion = $_GET['cotizacion'];
                ?>
                <h5> Nº Cotizacion: {{ $cotizacion }}</h5>
                <h5> valor total:$ {{ $valor_total }}</h5>
            @endif
        </div>
    </div>
   
    <div class="row justify-content-around">
        <div class="col text-center">
            <form method="POST" action="{{ route('detalles.cancelar') }}" class="col-md-10" style= "float: right;">
                @csrf
                <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacion}} readonly="readonly" hidden= "true">
                <button type="submit" class='btn btn-warning'>Cancelar</button>
            </form>
        </div>
        <div class="col text-center" >
            <a href="{{'/detalles_cotizaciones/create?cotizacion='.$cotizacion}}" class="btn btn-primary"> Agregar Producto</a>
        </div>
        <div class="col text-center" >
            <form method="POST" action="{{ route('cotizaciones.total') }}" class="col-md-10" style= "float: right;">
                @csrf
                <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacion}} readonly="readonly" hidden= "true">
                <button type="submit" class="btn btn-success" >continuar</button>
            </form>
        </div>
    </div>

    <br>

    <div class="">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="table-responsive-md">
                    <table class="table table-success table-bordered table-striped table-hover table-dark border-light" style="width: fit-content">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Descuento</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($detalle as $num=>$detalle )
                            <tr>
                                <td>{{ $num+1 }}</td>
                                <td>{{ $detalle->codigo_producto }}</td>
                                <td>{{ $detalle->nombre_producto }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->valor }}</td>
                                <td>{{ $detalle->descuento }}%</td>
                                <td>{{ $detalle->subtotal }}</td>
                                <td>
                                    <div class="col text-center">
                                        <form method="POST" action="{{ route('detalles.borrar') }}" class="col-md-10">
                                            @csrf
                                            <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacion}} readonly="readonly" hidden= "true">
                                            <input class="form-control" type="text" id="producto" name="producto" value={{$detalle->codigo_producto}} readonly="readonly" hidden= "true">
                                            <button type="submit" class='btn btn-danger'>Borrar</button>
                                        </form>
                                    </div>
                                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection
