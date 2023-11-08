@extends('layout.master')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
Plastiweb
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
@section('main')

    <div class="row justify-content-start">
        <div class="col-lg-5 col-md-10" style="width: fit-content">
            <a href="{{ route("productos.inventario") }}">
                <img src="public/img/logos/comida.png" class="foto img-fluid" style="width: fit-content" alt="...">
            </a>
        </div>
        <div class="col align-self-center">
            <div style="text-align: center; color: #a6ddb6">
                <label class="titulo">COMERCIALIZADORA Y DISTRIBUIDORA<BR> DE PRODUCTOS DESECHABLES.</label>
            </div>
            <br>
            <div class="subtext" style="margin-bottom: 1.6em; margin-top: 1em; color: #a6ddb6">
                <label> 
                    <p>Productos de polietileno de primera categoria.</p>
                    <p>En plastiweg somos pioneros en transportar y comercializar productos de excelente calidad y amigables con el medio ambiente.</p>
                    <p>Nuestra propuesta para este año es consolidarnos como una empresa lider dentro del mercado, con una mirada hacia el futuro.</p>
                </label>
            </div>
            <div class="row">
                <div class="col" >
                    {{-- //STOCKS --}}
                    @if ($stocks!= null && $stocks[0] != null)
                        <label style="background-color: #7d1a31">Productos en stock critico</label>
                        <table class="table table-striped table-bordered border-dark" style="width: fit-content">
                            <thead style="background-color: #26805f">
                                <tr style="font-size: 10pt;">
                                    <th scope="col">#</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Stock Actual</th>
                                    <th scope="col">Stock Crítico</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #7d1a31">
                                @foreach ($stocks as $num=>$stock )
                                    <tr style="font-size: 9pt;">
                                        @if ($stock->deleted_at == null )
                                            <td style="color: white">{{ $num + 1  }}</td>
                                            <td style="color: white">{{ $stock->codigo_producto }}-{{$stock->nombre_producto}}</td>
                                            <td style="color: white; font-size: medium">{{ $stock->stock_empaques}}</td>
                                            <td style="color: white">{{ $stock->stock_critico_empaques}}</td>
                                        @endif
                                    </tr>
                                 @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="border: 0em">
                                        <div class="row pagination" style="display: grid; place-items: center;">
                                            <div class="col-auto">
                                              {{ $stocks->links() }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                    @endif
                </div>
                <div class="col">
                    {{-- //COTIZACIONES --}}
                    @if ($cotizaciones != null && $cotizaciones[0] != null)
                        <label style="background-color: #7d1a31">Cotizaciones vencidas</label>
                        <table class="table table-dark table-striped table-bordered border-dark" style="width: fit-content">
                            <thead style="background-color: #26805f">
                                <tr style="font-size: 10pt;">
                                    <th scope="col">#</th>
                                    <th scope="col">N° Cotizacion</th>
                                    <th scope="col">Fecha emision</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #7d1a31">
                                @foreach ($cotizaciones as $num=>$cotizacion )
                                    <tr style="font-size: 9pt;">
                                        <td style="color: white">{{ $num + 1  }}</td>
                                        <td style="color: white">{{ $cotizacion->num_cotizacion}}</td>
                                        <td style="color: white">{{ $cotizacion->fecha_emision}}</td>
                                    </tr>
                                 @endforeach 
                            </tbody>
                        </table>
                        <div class="row pagination" style="display: grid; place-items: center;">
                            <div class="col-auto">
                              {{ $cotizaciones->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <hr>
        <div class="container-fluid" >
            <div class="row">
                <div class="col-auto"><img src="public/img/logos/plastiweg-logo-azul.png" alt="plastiwegLogo" class="rounded float-start imgMedium img-fluid"></div>
                <div class="col-md row-sm text-center">
                    <div class="row">
                        <h5 style="color: #70a899; text-align: center; margin-bottom: 0.1%;">JUAN LUIS GONZÁLEZ GÁLVEZ</h5>
                        <h6 style="color: #70a899; text-align: center; ">Comercialización de productos de Polietileno</h6>
                        <p class="footerText" style="margin-bottom: 0.2%;">
                            Bolsas ecológicas impresas - Bolsas negras - Bolsas Vacío <br>
                            Envases Desechables - Rollos Patelizar - Rollos Prepicados - <a style="color:#76aeff;" href="/productos">más...</a> 
                        </p>
                        <hr style="width: 50%; margin: auto; margin-bottom: 1%;">
                        <div class="d-flex justify-content-md-evenly justify-content-sm-center">
                            <address>
                                <p class="footerText" >
                                    Email:  <a style="color:#76aeff;" href="mailto:jotalgege@gmail.com">jotalgege@gmail.com</a> - 
                                            <a style="color:#76aeff;" href="mailto:veronica.ale.lago.f@gmail.com">veronica.ale.lago.f@gmail.com</a>
                                </p>
                                <p class="footerText">
                                    Contacto: 
                                    <a style="color:#76aeff;" href="tel:+56990371163">+56990371163</a> -
                                    <a style="color:#76aeff;" href="tel:+5694775180">+5694775180</a>
                                </p>
                                <p class="footerText">
                                    Facebook: 
                                    <a style="color:#76aeff;" href="https://www.facebook.com/Comercializadora-veronica-104361738163759" target="_blank">
                                        <b>Comercializadora</b>
                                    </a>
                                </p>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
{{-- Fin Body --}}
{{--  --}}
