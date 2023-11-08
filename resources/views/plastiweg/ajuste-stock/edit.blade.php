<?php
  $mysqli = new mysqli('127.0.0.1', 'u304800088_root', 'o@EOzWe5', 'u304800088_plastiweb');
?>
@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - AJUSTE STOCK
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
{{-- no se editan ajustes --}}
{{-- Body --}}
@section('main')
    {{-- @auth --}}
        <div class="row">
            <div class="col-6 offset-3">
                <form method="POST" action="{{ route('ajuste.update', $ajusteStock->id_ajuste) }}" style="text-align: left">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-3">
                        <label for="tipo_ajuste">Tipo de ajuste: </label>
                        <select class="form-control" name="tipo_ajuste" id="tipo_ajuste" onchange="onChangeTipoAjuste()" required>
                            <option value="" selected>Seleccione...</option>
                            <option value="1"  @if ($ajusteStock->tipo_ajuste=='1') selected @endif>INGRESO</option>
                            <option value="2"  @if ($ajusteStock->tipo_ajuste=='2') selected @endif>EGRESO</option>
                        </select>
                    </div>
                    {{-- fecha actual --}}
                    <div class="form-group">
                        <label for="cantidad_ajuste">Cantidad: </label>
                        <input value="{{ $ajusteStock->cantidad_ajuste }}" type="number" min="0" id="cantidad_ajuste" 
                            name="cantidad_ajuste" class="form-control" 
                            oninvalid="this.setCustomValidity('* Ingrese cantidad o cantidad errónea')"  oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_ajuste">Motivo: </label>
                        <select class="form-control" name="motivo_ajuste" id="motivo_ajuste" required>
                            <option value="">Seleccione...</option>
                            <script type="text/javascript">
                                function onChangeTipoAjuste(){
                                    if ($("#tipo_ajuste").val() == '1') {
                                        $('#motivo_ajuste').empty();
                                        $('#motivo_ajuste').append('<option value="" selected>Seleccione...</option>');
                                        $('#motivo_ajuste').append('<option value="1">ABASTECIMIENTO</option>');
                                    }else{
                                        $('#motivo_ajuste').empty();
                                        $('#motivo_ajuste').append('<option value="" selected>Seleccione...</option>');
                                        $('#motivo_ajuste').append('<option value="2">PÉRDIDA</option>');
                                        $('#motivo_ajuste').append('<option value="3">DEPRECIACIÓN</option>');
                                    }
                                }
                            </script>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_producto">Producto: </label>
                        <div class="form-group">
                            <select class="form-control" id='producto' name='producto' required>
                                <option value="" selected>--</option>
                                <?php
                                    $query = $mysqli -> query ("SELECT * FROM producto");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        if ($valores['id_producto'] == $ajusteStock->producto_id_producto) {
                                            echo '<option value="'.$valores['id_producto'].'" selected>'.$valores['nombre_producto'].'</option>';
                                        }else {
                                            echo '<option value="'.$valores['id_producto'].'">'.$valores['codigo_producto'].' - '.$valores['nombre_producto'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('ajuste') }}" class="btn btn-danger">CANCELAR</a>
                            </div>
                            <div class="col offset-3">
                                <button type="submit" class="btn btn-success">MODIFICAR</button>
                            </div>
                        </div>
                        
                        
                    </div>
                </form>
            </div>
        </div>
    {{-- @endauth --}}
@endsection
{{-- Fin Body --}}
{{--  --}}
