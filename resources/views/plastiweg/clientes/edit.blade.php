@extends('layout.master')
{{--  --}}

{{-- Titulo Pagina --}}
@section('title')
Plastiweb - Clientes
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')
<section class="appointment-area">
    <div class="container">
        <div class="row" style="justify-content: center;">
            <div class="col-lg-6 col-sm-12 p-0">
                <div class="appointment-here-form">					
                    <h2>Edición Cliente</h2>
                    <div class="contact-wrap contact-pages mb-0">
                        <div class="contact-form">
                            <form method="POST" action="{{ route('cliente.update', $clientes->id_cliente ) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <p style="color:#3BC1CD">* Campo obligatorio</p>
                                        <p></p>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="region">Region</label>
                                        <div class="form-group">
                                            <select class="form-control" id='region' name='region' onchange="onChangeRegion(this.value);">
                                                @foreach ($regiones as $region)
                                                    @if (isset($_GET['valor']))
                                                        @if ($region->id_region == $_GET['valor'])
                                                            <option value="{{ $region->id_region }}" selected>{{ $region->nombre_region }}</option>
                                                        @else
                                                            <option value="{{ $region->id_region }}"> {{ $region->nombre_region }} </option>
                                                        @endif
                                                    @else
                                                        @if ($region->id_region == $clientes->id_region)
                                                            <option value="{{ $region->id_region }}" selected>{{ $region->nombre_region }}</option>
                                                        @else
                                                            <option value="{{ $region->id_region }}"> {{ $region->nombre_region }} </option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="comuna">Comuna</label>
                                        <div class="form-group">
                                            <select class="form-control" id='comuna' name='comuna'>
                                                @foreach ($comunas as $comuna)
                                                    @if (isset($_GET['valor']))
                                                        @if ($comuna->region_id_region == $_GET['valor'])
                                                            <option value="{{ $comuna->id_comuna }}">{{ $comuna->nombre_comuna }}</option>
                                                        @endif
                                                    @else
                                                        @if ($comuna->id_comuna == $clientes->Comuna_idComuna)
                                                            <option value="{{ $comuna->id_comuna }}" selected> {{ $comuna->nombre_comuna }} </option>
                                                        @else
                                                            <option value="{{ $comuna->id_comuna }}"> {{ $comuna->nombre_comuna }} </option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <label for="rut">Rut *</label>
                                        <div class="form-group">
                                            <input type="text" name="rut" id="rut" class="form-control" required data-error="* Ingresa rut" oninput="checkRut(this)" value="{{ $clientes->rut }}" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="nombre">Nombre *</label>
                                        <div class="form-group">
                                            <input type="text" max="45" name="nombre" id="nombre" class="form-control" required data-error="* Ingresa nombre"  value="{{ $clientes->nombre_cliente }}" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <label for="apellido">Apellido</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="apellido" id="apellido" class="form-control" value="{{ $clientes->apellido_cliente }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <label for="telefono">Teléfono</label>
                                        <div class="form-group">
                                            <input type="text" max="20" name="telefono" id="telefono" class="form-control" value="{{ $clientes->telefono_contacto_cliente }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <label for="email">Email</label>
                                        <div class="form-group">
                                            <input type="email" max="45" name="email" id="email" class="form-control" value="{{ $clientes->correo }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <label for="direccion">Direccion</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="direccion" id="direccion" class="form-control" value="{{ $clientes->direccion_cliente }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="direccion_despacho">Dirección de despacho</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="direccion_despacho" id="direccion_despacho" class="form-control" value="{{ $clientes->direccion_despacho }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="nombre_pers_contacto">Nombre persona de contacto</label>
                                        <div class="form-group">
                                            <input type="text" max="45" name="nombre_pers_contacto" id="nombre_pers_contacto" class="form-control" value="{{ $clientes->nombre_pers_contacto }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label for="telefono_pers_contacto">Telefono persona de contacto</label>
                                        <div class="form-group">
                                            <input type="text" max="20" name="telefono_pers_contacto" id="telefono_pers_contacto" class="form-control" value="{{ $clientes->telefono_pers_contacto }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 col-sm-12" style="padding-top: 5%;">
                                        <a href="{{ route('cliente.show', $clientes->id_cliente) }}" class="btn btn-warning" style= "float: left;">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-success" style= "float: right;">
                                            Guardar
                                        </button>
                                        <script src="validarRUT.js"></script>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function onChangeRegion(valor){
        location.href='?valor=' + valor;
    }
    function checkRut(rut) {
        // Despejar Puntos
        var valor = rut.value.replace('.','');
        // Despejar Guión
        valor = valor.replace('-','');
        
        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor.slice(0,-1);
        dv = valor.slice(-1).toUpperCase();
        
        // Formatear RUN
        rut.value = cuerpo + '-'+ dv
        
        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
        
        // Calcular Dígito Verificador
        suma = 0;
        multiplo = 2;
        
        // Para cada dígito del Cuerpo
        for(i=1;i<=cuerpo.length;i++) {
        
            // Obtener su Producto con el Múltiplo Correspondiente
            index = multiplo * valor.charAt(cuerpo.length - i);
            
            // Sumar al Contador General
            suma = suma + index;
            
            // Consolidar Múltiplo dentro del rango [2,7]
            if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
    
        }
        
        // Calcular Dígito Verificador en base al Módulo 11
        dvEsperado = 11 - (suma % 11);
        
        // Casos Especiales (0 y K)
        dv = (dv == 'K')?10:dv;
        dv = (dv == 0)?11:dv;
        
        // Validar que el Cuerpo coincide con su Dígito Verificador
        if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
        
        // Si todo sale bien, eliminar errores (decretar que es válido)
        rut.setCustomValidity('');
    }
</script>
@endsection
{{-- Fin Body --}}
