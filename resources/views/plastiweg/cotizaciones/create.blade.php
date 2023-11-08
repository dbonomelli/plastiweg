<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="public/img/logos/plastiwegLogo-verde32.ico" />
    <link type="text/css" href="{{ asset('public/css/master/nav_style.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('public/css/cotizacion/index.css') }}" rel="stylesheet">
    <title>Plastiweb - Cotizacion</title>
</head>
{{-- @auth --}}
<body>
    <?php
      $mysqli = new mysqli('127.0.0.1', 'u304800088_root', 'o@EOzWe5', 'u304800088_plastiweb');
    ?>
    <div class="container-fluid" >
        {{-- CONTENIDO PRINCIPAL --}}
        <div class="stepper-conf">
            <div class="init-step"></div>
            <div class="cont-steps">
              <!-- Step1 -->
              <div class="step active">
                <div class="step-icon">
                  <i>1</i>
                </div>
                <div class="label-step">
                  Selección
                </div>
              </div>
          
              <!-- Step2 -->
              <div class="step">
                <div class="step-icon">
                  <i>2</i>
                </div>
                <div class="label-step">
                  Cliente
                </div>
              </div>
          
              <!-- Step3 -->
              <div class="step">
                <div class="step-icon">
                  <i>3</i>
                </div>
                <div class="label-step">
                  Confirmación
                </div>
              </div>
            </div>
        </div>
    </div>
    <section class="appointment-area">
        <div class="container">
            <div class="jumbotron">
                <form action="{{ route('cotizaciones.store') }}" method="post" name="form_prod">     
                    <div class="col-auto">
                        <label class="sr-only" for="region">Producto</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend col-4">
                                <div class="input-group-text col-12">Producto</div>
                            </div>
                            <select class="form-control" id='cliente' name='nombre_producto' required>
                                <option value="" selected>--</option>
                                <?php
                                  $query = $mysqli -> query ("SELECT * FROM producto");
                                  while ($prods = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$prods['nombre_producto'].'">'.$valores['codigo_producto'].' - '.$prods['nombre_producto'].'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="telefono">Cantidad</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend col-4">
                                <div class="input-group-text col-12">
                                    <div style="width:50%; text-align:left">Cantidad</div>
                                </div>
                            </div>
                            <input type="number"  id="cantidad" name="cantidad" value="1" min='1' placeholder="912345678" minlength="9" maxlength="9" required>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-10 offset-sm-1">
                        <input type="submit" class="btn btn-lg btn-success" value="CONTINUAR">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function msg() {
          alert("Producto agregado!");
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
