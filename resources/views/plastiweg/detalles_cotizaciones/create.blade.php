@extends('layout.master')

@section('title')
Plastiweb - Agregar Producto
@endsection

<head>
    <link type="text/css" href="{{ asset('public/css/detalleCotizacion/create.css') }}" rel="stylesheet">
</head>

@section('main')
<?php 
    $cotizacion = $_GET['cotizacion'];
?>
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('cotizaciones.volver') }}">
                    @csrf
                    <input class="form-control" type="text" id="cotizacion" name="cotizacion" value={{$cotizacion}} readonly="readonly" hidden= "true">
                    <button type="submit" class="btn btn-warning"> 
                        Cancelar
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center">
                    <form action="{{ route('detalles.store') }}" method="POST" enctype="multipart/form-data">     
                        @csrf
                        <div class="form-group">
                            <div class="row" style="width: fit-content">
                                <label class='lbl_form' for=cotizacion>N° de Cotizacion:</label>
                                <input  type="number" id='cotizacion' name='cotizacion' class='form-control' value={{$cotizacion}} readonly="readonly">
                            </div>
                            <div class="row" style="width: fit-content">
                                <label class='lbl_form' for=id>Producto: </label>
                                <select class="form-control" required id='id_producto' name='id_producto' class="form-control" required>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id_producto }}">{{ $producto->codigo_producto }} -- {{ $producto->nombre_producto }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row" style="width: fit-content">
                                <div class="col">
                                    <label class='lbl_form' for=cantidad>Cantidad: </label>
                                    <input type="number" id='cantidad' name='cantidad' class='form-control' value='1' min='1' max='9999' required >
                                </div>
                                <div class="col">
                                    <label class='lbl_form' for=cantidad>Descuento: </label>
                                    <input type="number" id='descuento' name='descuento' class='form-control' value='0' min='0' max='100' required >
                                </div>
                            </div>
                            <div class="row mt-2" style="width: fit-content">
                                <button type="submit" class="btn btn-primary"> Agregar producto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection