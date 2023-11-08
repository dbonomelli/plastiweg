
@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - AJUSTE STOCK
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}
{{--  --}}
{{-- Body --}}
@section('main')
    
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="POST" action="{{ route('ajuste.store') }}" style="text-align: left">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="tipo_ajuste">Tipo de ajuste: </label>
                        <select class="form-control" name="tipo_ajuste" id="tipo_ajuste" onchange="onChangeTipoAjuste()" required>
                            <option value="" selected>Seleccione...</option>
                            <option value="1">INGRESO</option>
                            <option value="2">EGRESO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_ajuste">Cantidad: </label>
                        <input type="number" min="0" id="cantidad_ajuste" name="cantidad_ajuste" class="form-control"
                            oninvalid="this.setCustomValidity('* Ingrese cantidad o cantidad errónea')"  oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_ajuste">Motivo: </label>
                        <select class="form-control" name="motivo_ajuste" id="motivo_ajuste" required>
                            <option value="" selected>Seleccione...</option>
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
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id_producto }}">{{ $producto->codigo_producto }} -- {{ $producto->nombre_producto }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="float-left col">
                                <a href="{{ route('ajuste') }}" class="btn btn-danger">CANCELAR</a>
                            </div>
                            <div class="float-right col offset-md-3">
                                <button type="submit" class="btn btn-success" >AJUSTAR STOCK</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
{{-- Fin Body --}}
{{--  --}}


