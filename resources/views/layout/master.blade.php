<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="public/img/logos/plastiwegLogo-verde32.ico" />
    <link type="text/css" href="{{ asset('css/master/nav_style.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/index/style.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>

<body>
    <div class="container-fluid" >
        {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-md navbar-color" style="padding: 2%;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route("inicio") }}" style="text-decoration: none; color: #a6ddb6" >
                    <h2><b>PLASTIWEG.</b></h1>
                </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarPaginas" aria-controls="navbarPaginas" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarPaginas">
                    <div class="navbar-nav mr-auto">
                        <li>
                            <a id="nav-cotizacion" class="nav-link active" style="color: #a6ddb6" href="{{ route("cotizaciones") }}" >Cotización</a>
                        </li> 
                        <li>
                            <a id="nav-producto" class="nav-link active" style="color: #a6ddb6" href="{{ route("productos.inventario") }}" >Inventario</a>
                        </li>
                        <li>
                            <a id="nav-cliente" class="nav-link active" style="color: #a6ddb6" href="{{ route("cliente") }}">Clientes</a>
                        </li>
                        <li>
                            <a id="nav-vendedor" class="nav-link active" style="color: #a6ddb6" href="{{ route("vendedor.lista") }}">Vendedor</a>
                        </li>
                        <li>
                            <a id="nav-informe" class="nav-link active" style="color: #a6ddb6" href="{{ route('ventas') }}">Ventas</a>
                        </li>
                        <li>
                            <a id="nav-informe" class="nav-link active" style="color: #a6ddb6" href="{{ route('facturas') }}">Facturas</a>
                        </li>
                    </div>
                </div>
                <div class="navbar-nav d-flex mt-1">
                    <a href="{{ route('vendedor.logout') }}" class="btn btn-outline-danger" style=" font-size: 9pt"><b>cerrar sesion</b></a>
                </div>
            </div>
        </nav>
        
    </div>
    {{-- CONTENIDO PRINCIPAL --}}
    <div class="container-fluid pt-4" style="background-color: #014034">
        @yield('main')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>