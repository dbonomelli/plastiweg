<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>PLASTIWEG -  INICIO SESION</title>     
        <link type="text/css" href="{{ asset('public/css/vendedores/vendedores.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" href="public/img/logos/plastiwegLogo-verde32.ico" />
    </head>
    <body>
        {{--  --}}
        {{-- INICIO NAVBAR --}}
        <div>
           <nav class="navbar navbar-expand-md navbar-color offset-1 mb-3">
                <div class="container-fluid">
                    <h1><b>PLASTIWEG.</b></h1>
                </div>
            </nav> 
        </div>
        {{-- FIN NAVBAR --}}
        {{--  --}}
          
        {{--  --}}
        {{-- Main Body --}}
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-8 col-sm offset-md-2 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Plastiweg - Autorización</strong>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{$error}}
                                            </li>  
                                        @endforeach
                                    </ul>
                                </div>
                            @endif 
                            <form method="POST" action="{{ route('vendedor.login') }}">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="row">
                                            <label>Usuario:</label>
                                            <div class="form-group">
                                                <input type="text" name="usuario" id="usuario" class="form-control" required="" maxlength="45"
                                                 placeholder="Ingrese nombre de usuario" oninvalid="this.setCustomValidity('* Ingrese usuario')"  oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label>Contraseña: </label>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" class="form-control" required="" maxlength="150"
                                                placeholder="*******" oninvalid="this.setCustomValidity('* Ingrese password')"  oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col btn-ingreso">
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success">INGRESAR</button>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg row-md mt-2">
                  <div class="card" style="width: fit-content">
                    <div class="card-body">
                      <a class="btn btn-info " href="{{route('home')}}">Ingresar como invitado</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin Main Body --}}
    {{--  --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    </body>
</html>
