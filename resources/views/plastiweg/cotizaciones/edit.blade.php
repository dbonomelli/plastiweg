<?php
  $mysqli = new mysqli('127.0.0.1', 'u304800088_root', 'o@EOzWe5', 'u304800088_plastiweb');
?>
@extends('layout.master')

@section('title')
Plastiweb - Cotizacion
@endsection

<head>
    <link type="text/css" href="{{ asset('public/css/cotizacion/edit.css') }}" rel="stylesheet">
</head>

@section('main')

<section class="appointment-area">
    <div class="container">
        <div class="jumbotron">
            <form action="{{ route('cotizaciones.store') }}" method="post" name="form_prod">     
                <div class="col-auto">
                    <label class="sr-only" for="region">Producto</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend col-4">
                            <div class="input-group-text col-12">Producto</div>
                        </div>
                        <select class="form-control" id='cliente' name='nombre_producto' required>
                            <option value="0" selected>--</option>
                            <?php
                              $query = $mysqli -> query ("SELECT * FROM producto");
                              while ($prods = mysqli_fetch_array($query)) {
                                echo '<option value="'.$prods['nombre_producto'].'">'.$valores['codigo_producto'].' - '.$prods['nombre_producto'].'</option>';
                              }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="telefono">Cantidad</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend col-4">
                            <div class="input-group-text col-12">
                                <div style="width:50%; text-align:left">Cantidad</div>
                            </div>
                        </div>
                        <input type="number"  id="cantidad" name="cantidad" value="1" min='1' placeholder="912345678" minlength="9" maxlength="9" required>
                    </div>
                </div>
                <br>
                <div class="col-sm-10 offset-sm-1">
                    <input type="submit" class="btn btn-lg btn-success" value="CONTINUAR">
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function msg() {
      alert("Producto agregado!");
    }
</script>
@endsection