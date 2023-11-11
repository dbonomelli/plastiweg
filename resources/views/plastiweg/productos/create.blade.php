@extends('layout.master')

{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
PLASTIWEG - INGRESO PRODUCTOS
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- comienzo body --}}
@section('main')
<section class="appointment-area">
    <div class="container-fluid">
        <div class="row d-flex justify-content-start" style="width: fit-content">
            <a href="{{ route('productos.inventario') }}" class="btn btn-warning" style= "float: left;">
                Cancelar
            </a>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row">
                <h2>Nuevo Producto</h2>
                <p style="color:#3BC1CD">* Campo obligatorio</p>
            </div>
        </div>
        <div class="d-flex justify-content-center" >
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data" style="text-align: left">
                        @csrf
                        @method('POST')
                        <div class="row" style="width: fit-content">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre_producto">* Nombre producto: </label>
                                    <input class="form-control" max="45" type="text" required="" id="nombre_producto" name="nombre_producto" maxlength="45" 
                                    placeholder="Ingrese nombre producto"  oninvalid="this.setCustomValidity('Ingrese nombre del producto')"
                                    data-toggle="tooltip" title="Nombre del producto." oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group">
                                    <label for="contenido_unidades_por_empaque">Unidades por empaque: </label>
                                    <input type="number" min="1" max="99999" id="contenido_unidades_por_empaque" name="contenido_unidades_por_empaque"
                                    class="form-control" required="" placeholder="Ingrese unidades por empaque" oninvalid="this.setCustomValidity('* Ingrese unidades')" 
                                    data-toggle="tooltip" title="Cuantas unidades/productos contiene un empaque." oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock_empaques">Stock: </label>
                                    <input type="number" min="1" id="stock_empaques" name="stock_empaques" class="form-control" required="" maxlength="9"
                                    data-toggle="tooltip" title="Cuantos empaques o productos tiene."
                                    placeholder="Ingrese stock" oninvalid="this.setCustomValidity('* Ingrese stock')"  oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group">
                                    <label for="lugar_almacenamiento">Almacenamiento</label>
                                    <input type="text" id="lugar_almacenamiento" name="lugar_almacenamiento" class="form-control" required="" maxlength="45"
                                    data-toggle="tooltip" title="Lugar de guardado." data-toggle="tooltip" title="Lugar donde será guardado."
                                    placeholder="Ingrese lugar de almacenamiento" max="45" oninvalid="this.setCustomValidity('* Ingrese almacenamiento')"  oninput="setCustomValidity('')" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre_producto">* Codigo de producto: </label>
                                    <input class="form-control" max="45" type="text" required="" id="codigo_producto" name="codigo_producto" maxlength="45" 
                                    placeholder="Ingrese código de producto"  oninvalid="this.setCustomValidity('Ingrese codigo del producto')"
                                    data-toggle="tooltip" title="Código del producto." oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio_empaque">Precio: </label>
                                    <input type="number" min="1" max="99999" id="precio_empaque" name="precio_empaque" class="form-control" required=""
                                    data-toggle="tooltip" title="Cuanto vale un empaque o producto."
                                    placeholder="Ingrese precio del empaque" oninvalid="this.setCustomValidity('* Ingrese precio')" oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock_critico_empaques">Stock critico</label>
                                    <input type="number" min="1" max="99999" id="stock_critico_empaques" name="stock_critico_empaques" class="form-control" required=""
                                    data-toggle="tooltip" title="Cantidad de productos mínimos para alertar."
                                    placeholder="Ingrese stock critico" oninvalid="this.setCustomValidity('* Ingrese stock critico')"  oninput="setCustomValidity('')" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_imagen">Imagen </label>
                                    <input type="file" id="nombre_imagen" name="nombre_imagen" class="form-control" accept="image/png, image/jpg, image/jpeg">
                                </div>
                                <div id="imagen_elegida" style="display: flex; height: 200px; margin-top: 10px; justify-content: center; border: 1px solid green;"></div>
                            </div>
                        </div>
                        <div class="row" style="width: auto">
                            <div class="col" >
                                <div class="form-group">
                                    <label for="especificaciones">Especificaciones: </label>
                                    <textarea type="text" max="200" id="especificaciones" name="especificaciones" class="form-control" required="" maxlength="200"
                                             oninvalid="this.setCustomValidity('* Ingrese especificaciones')" 
                                             data-toggle="tooltip" title="Descripción detallada del producto." oninvalid="this.setCustomValidity('* Ingrese especificaciones')"
                                             oninput="setCustomValidity('')" placeholder="Ingrese especificación" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col my-3">
                                <button type="submit" class="btn btn-success" style= "float: right;">Agregar</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
{{-- Fin bofy --}}
{{--  --}}