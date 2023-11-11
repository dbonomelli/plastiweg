@extends('layout.master')

{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - MODIFICACIÓN PRODUCTO
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- comienzo body --}}
@section('main')
<div class="row">
    <div class="col-md-5 offset-md-3">
        <form method="POST" action="{{ route('productos.update', $producto->id_producto) }}" enctype="multipart/form-data" style="text-align: left">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre_producto">Nombre producto: </label>
                <input type="text" max="45" oninvalid="this.setCustomValidity('Ingrese nombre del producto')" required="" 
                maxlength="45"oninput="setCustomValidity('')" value="{{ $producto->nombre_producto }}" id="nombre_producto" 
                data-toggle="tooltip" title="Nombre del producto."
                placeholder="Ingrese aqui nombre producto" name="nombre_producto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre_producto">* <b> Codigo producto</b>: </label>
                <input class="form-control" max="45" type="text" required="" id="codigo_producto" name="codigo_producto" maxlength="45" 
                placeholder="Ingrese aqui codigo de producto"  value="{{ $producto->codigo_producto }}"
                data-toggle="tooltip" title="Código del producto."
                oninvalid="this.setCustomValidity('Ingrese codigo del producto')" oninput="setCustomValidity('')" required>
                
            </div>
            <div class="form-group">
                <label for="contenido_unidades_por_empaque">Unidades por empaque: </label>
                <input type="number" min="1" max="99999" value="{{ $producto->contenido_unidades_por_empaque }}" 
                id="contenido_unidades_por_empaque" name="contenido_unidades_por_empaque" class="form-control"
                data-toggle="tooltip" title="Cuantas unidades/productos contiene un empaque." 
                required="" placeholder="Ingrese aqui unidades" oninvalid="this.setCustomValidity('* Ingrese unidades')" 
                oninput="setCustomValidity('')" required>
            </div>
            <div class="form-group">
                <label for="precio_empaque"><b>Precio</b> por empaque: </label>
                <input type="number" min="1" max="99999" value="{{ $producto->precio_empaque }}" 
                id="precio_empaque" name="precio_empaque" class="form-control"
                required="" placeholder="Ingrese aqui el precio del empaque"
                data-toggle="tooltip" title="Cuanto vale un empaque o producto."
                oninvalid="this.setCustomValidity('* Ingrese precio')" oninput="setCustomValidity('')" required>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="lugar_almacenamiento">Stock</label>
                        <input type="text" style="background-color: rgb(168, 168, 168)" disabled value="{{ $producto->stock_empaques }}" 
                                data-toggle="tooltip" title="Para modicifar STOCK debe realizar un ajuste de stock." id="stock_empaques" name="stock_empaques" class="form-control" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="stock_critico_empaques">Stock critico: </label>
                        <input type="number" min="1" max="99999" value="{{ $producto->stock_critico_empaques }}" id="stock_critico_empaques" name="stock_critico_empaques" class="form-control"
                        data-toggle="tooltip" title="Cantidad de productos mínimos para alertar."
                        required="" placeholder="Ingrese aqui stock critico" oninvalid="this.setCustomValidity('* Ingrese stock critico')"  oninput="setCustomValidity('')" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="lugar_almacenamiento">Imagen Producto (Si no quiere cambiar la imagen, déjelo vacío) </label>
                <input type="file" id="nombre_imagen" name="nombre_imagen" class="form-control" accept="image/png, image/jpg, image/jpeg">
            </div>
            <div id="imagen_elegida" style="display: flex; height: 200px; margin-top: 10px; justify-content: center; border: 1px solid green;">
                <img src="{{$producto->imagen? $producto->imagen : $producto->defaultImage }}" alt="">
            </div>
            <div class="form-group">
                <label for="especificaciones">Especificaciones: </label>
                {{-- <input type="text" maxlength="200" value="{{ $producto->especificaciones }}" id="especificaciones" name="especificaciones" class="form-control"
                placeholder="Ingrese aqui especificaciones" oninvalid="this.setCustomValidity('* Ingrese especificaciones')"  oninput="setCustomValidity('')" required> --}}
                <textarea type="text" maxlength="200" id="especificaciones" name="especificaciones" class="form-control"
                            placeholder="Ingrese aqui especificaciones" oninvalid="this.setCustomValidity('* Ingrese especificaciones')" 
                            data-toggle="tooltip" title="Descripción detallada del producto."
                            oninput="setCustomValidity('')" required >{{ $producto->especificaciones }}</textarea>
            </div>
            <div class="form-group">
                <label for="lugar_almacenamiento">Almacenamiento</label>
                <input type="text" maxlength="45" value="{{ $producto->lugar_almacenamiento }}" id="lugar_almacenamiento" name="lugar_almacenamiento" class="form-control"
                    data-toggle="tooltip" title="Lugar de guardado."
                    required="" placeholder="Ingrese aqui lugar almacenamiento" max="45" oninvalid="this.setCustomValidity('* Ingrese almacenamiento')"  oninput="setCustomValidity('')" required>
            </div>
            <div class="form-group mt-2">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn btn-danger">CANCELAR</a>
                            <button type="submit" class="btn btn-success">MODIFICAR PRODUCTO</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const chooseFile = document.getElementById("nombre_imagen");
    const imgPreview = document.getElementById("imagen_elegida");
    chooseFile.addEventListener("change", function () {
        getImgData();
    });
    function getImgData(){
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
            imgPreview.style.display = "flex";
            imgPreview.innerHTML = '<img src="' + this.result + '" />';
            });    
        }
    }
</script>
@endsection
{{-- Fin body --}}
{{-- --}}