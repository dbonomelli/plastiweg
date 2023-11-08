
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
        <div class="row mb-3 d-flex justify-content-start">
            <a href="{{ route('cliente') }}" class="btn btn-warning" style="width: fit-content">Cancelar</a>
        </div>
        <div class="row" style="justify-content: center;">
            <div class="col-lg-6 col-sm-12 p-0">
                <div class="appointment-here-form">					
                    <h2 style="margin-bottom: 1em">Detalle Cliente</h2>
                    <div class="contact-wrap contact-pages mb-0">
                        <div class='row'>
                            <div class='col'>
                                <div class="contact-form">
                                    <div class="col">
                                        <label for="rut">Rut</label>
                                        <div class="form-group">
                                            <input type="text" name="rut" id="rut" disabled style="color: white" value="{{ $cliente->rut }}">
                                        </div>
                                        <label for="nombre">Nombre</label>
                                        <div class="form-group">
                                            <input type="text" max="45" name="nombre" id="nombre" disabled style="color: white"  value="{{ $cliente->nombre_cliente }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="apellido">Apellido</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="apellido" id="apellido" disabled style="color: white" value="{{ $cliente->apellido_cliente }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="telefono">Teléfono</label>
                                        <div class="form-group">
                                            <input type="text" max="20" name="telefono" id="telefono" disabled style="color: white" value="{{ $cliente->telefono_contacto_cliente }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="email">Email</label>
                                        <div class="form-group">
                                            <input type="email" max="45" name="email" id="email" disabled style="color: white" value="{{ $cliente->correo }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="direccion">Direccion</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="direccion" id="direccion" disabled style="color: white" value="{{ $cliente->direccion_cliente }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="telefono_pers_contacto">Region</label>
                                        <div class="form-group">
                                            <input type="text" max="20" name="telefono_pers_contacto" id="telefono_pers_contacto" disabled style="color: white"value="{{ $cliente->nombre_region }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="telefono_pers_contacto">Comuna</label>
                                        <div class="form-group">
                                            <input type="text" max="20" name="telefono_pers_contacto" id="telefono_pers_contacto" disabled style="color: white"value="{{ $cliente->nombre_comuna }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col" style='visibility:hidden'>
                                        <label for="direccion_entrega_od">Dirección orden de despacho </label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="direccion_entrega_od" id="direccion_entrega_od" disabled style="color: white" value="{{ $cliente->direccion_entrega_od }}">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            {{-- PERSONA CONTACTO --}}
                            <div class="col">
                                <div class="contact-form">
                                    <div class="col">
                                        <label for="nombre_pers_contacto">Persona de contacto</label>
                                        <div class="form-group">
                                            <input type="text" max="45" name="nombre_pers_contacto" id="nombre_pers_contacto" disabled style="color: white" value="{{ $cliente->nombre_pers_contacto }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="telefono_pers_contacto">Telefono persona de contacto</label>
                                        <div class="form-group">
                                            <input type="text" max="20" name="telefono_pers_contacto" id="telefono_pers_contacto" disabled style="color: white"value="{{ $cliente->telefono_pers_contacto }}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="direccion_despacho">Dirección de despacho</label>
                                        <div class="form-group">
                                            <input type="text" max="50" name="direccion_despacho" disabled style="color: white" value="{{ $cliente->direccion_despacho }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 my-3">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('cliente.edit', $cliente->id_cliente) }}" class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal">ELIMINAR</button>
                            </div>
                        </div>  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- MODAL --}}
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel" style="color: black">ELIMINAR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="color: black">¿Desea eliminar al cliente {{ $cliente->nombre_cliente }}{{ $cliente->apellido_cliente }} ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>

        <form method="POST" action="{{ route('cliente.destroy', $cliente->id_cliente) }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">DAR DE BAJA</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- Fin Body --}}
