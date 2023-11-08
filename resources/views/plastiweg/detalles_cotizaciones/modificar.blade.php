<?php
  $mysqli = new mysqli('127.0.0.1', 'u304800088_root', 'o@EOzWe5', 'u304800088_plastiweb');
?>
@extends('layout.master')

@section('title')
Plastiweb - Cotizacion
@endsection

<head>
    <link type="text/css" href="{{ asset('public/css/detalleCotizacion/modificar.css') }}" rel="stylesheet">
</head>

@section('main')


@csrf
<div >
   @if ($cotizacion)
        <h5> Nº Cotizacion: {{ $cotizacion }}</h5>
    @else
        <?php 
            $cotizacion = $_GET['cotizacion'];
        ?>
        <h5> Nº Cotizacion: {{ $cotizacion }}</h5>
    @endif
    <br>
    <div class="row">
        <div class="col text-center">
            <a href="{{ route('cotizaciones.consulta') }}">Volver</a>
        </div>
        <div class="col text-center" >
            <a href="{{'/detalles_cotizaciones/create?cotizacion='.$cotizacion}}" class="btn btn-success"> Agregar Producto</a>
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

    <div class="jumbotron">
        <div class="row">
            <div class="col">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>N</th>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Valor</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalle as $num=>$detalle )
                            <tr style="background-color: ddd;">
                                <td>{{ $num+1 }}</td>
                                <td>{{ $detalle->codigo_producto }}</td>
                                <td>{{ $detalle->nombre_producto }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->valor }}</td>
                                <td>{{ $detalle->subtotal }}</td>
                                <td>
                                    <div class="col text-center">
                                        <form method="POST" action="{{ route('detalles.borrar') }}" class="col-md-10" style= "float: right;">
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

<?php
    extract($_GET);
    if(@$idborrar==2){
        $sqlborrar="DELETE FROM cotizaciones WHERE num_cotizacion=$id";
        $resborrar=mysqli_query($conexion,$sqlborrar);
        echo '<script>alert("ELIMINADO")</script> ';
        echo "<script>location.href='{{ /cotizaciones/create }}'</script>";
    }
?>
@endsection
