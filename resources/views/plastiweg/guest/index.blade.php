@extends('layout.masterGuest')
{{--  --}}
{{-- Titulo Pagina --}}
@section('title')
Plastiweb
@endsection
{{-- Fin Titulo Página --}}
{{--  --}}

{{--  --}}
{{-- Body --}}
<head>
    <link type="text/css" href="{{ asset('guest/footer.css') }}" rel="stylesheet">
</head>
@section('main')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-lg-5 col-md-10" style="width: fit-content">
            <img src="{{ asset('img/logos/comida.png') }}" class="foto img-fluid" style="width: fit-content" alt="...">
        </div>
        <div class="col align-self-center">
            <div style="text-align: center; color: white">
                <label class="titulo">COMERCIALIZADORA Y DISTRIBUIDORA<BR> DE PRODUCTOS DESECHABLES.</label>
            </div>
            <br>
            <div class="subtext" style="width: 100%; margin-bottom: 1.6em; margin-top: 1em; color: white">
                <label> 
                    <p>Plastiweg es una empresa dedicada al transporte y comercialización de empaques fabricadas cien por ciento a base de polietileno de primera categoria.</p>
                    <p>En Plastiweg somos pioneros en transportar y comercializar productos de excelente calidad y amigables con el medio ambiente.</p>
                    <p> Nuestra propuesta para este año es consolidarnos como una empresa lider dentro del mercado, con una mirada hacia el futuro</p>
                </label>
            </div>
        </div>
    </div>
</div>
{{-- END BODY --}}

    {{--  --}}
 {{-- FOOTER --}}
 <footer class="footer">
    <hr>
    <div class="container-fluid" >
        <div class="row">
            <div class="col-auto"><img src="{{ asset('img/logos/plastiweg-logo-azul.png') }}" alt="plastiwegLogo" class="rounded float-start imgMedium img-fluid"></div>
            <div class="col-md row-sm text-center">
                <div class="row">
                    <h5 style="color: #70a899; text-align: center; margin-bottom: 0.1%;">JUAN LUIS GONZÁLEZ GÁLVEZ</h5>
                    <h6 style="color: #70a899; text-align: center; ">Comercialización de productos de Polietileno</h6>
                    <p class="footerText" style="margin-bottom: 0.2%;">
                        Bolsas ecológicas impresas - Bolsas negras - Bolsas Vacío <br>
                        Envases Desechables - Rollos Patelizar - Rollos Prepicados - <a style="color:#76aeff;" href="{{ route('catalogo') }}">más...</a> 
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
    {{-- END FOOTER --}}
@endsection
{{-- End-Body --}}