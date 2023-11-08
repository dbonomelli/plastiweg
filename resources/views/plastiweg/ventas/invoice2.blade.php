<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <body style="font-size: 0.9em">
        <style>
            .row{

            }
            .col-md-6{
                display: flex;
                justify-content: center;
                align-items: center;
                width: 10rem;
            }
            .backimage{
                display: block;
                justify-content: center;
                align-content: center;
            }
            .background{
                background-color: #FFFFFF;
            }
            .left-side-a1{
                text-align: center;
                height: 8rem;
                border: 2px solid black;
            }
            .title{
                font-weight: bold;
                font-size: 34px;
                color: #9BBB59;
            }
            .right-side-b1{
                height: 8rem;
                border-top: 2px solid black;
                border-bottom: 2px solid black;
                border-right: 2px solid black;
            }
            .bcell-data{
                height: 8rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                margin-right: 5rem;
            }
            .bcell-text{
                font-size: 15px;
                font-weight: bold;
                color: black;
            }
            .left-side-a2{
                display: flex;
                align-items: center;
                justify-content: center;
                height: 2rem;
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .right-side-b2{
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #9BBB59;
                height: 2rem;
                border-bottom: 2px solid black;
                border-right: 2px solid black;
            }
            .plastiweg{
                font-size: 12px;
                color: black;
                font-weight: bold;
            }
            .cellb2-data{
                font-size: 12px;
                color: #FFFFFF;
                font-weight: bold;
            }
            .left-side-a3{
                display: flex;
                align-items: baseline;
                justify-content: center;
                flex-direction: column;
                height: 5rem;
                border-left: 2px solid black;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .right-side-b3{
                display: flex;
                align-items: baseline;
                flex-direction: column;
                justify-content: left;
                height: 5rem;
                border-right: 2px solid black;
                border-bottom: 2px solid black;
            }
            .a3-data{
                font-weight: bold;
            }

            .grid-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: repeat(2, 1fr);
  grid-gap: 10px;
}

.box1 {
  grid-row: 1 / 2;
  grid-column: 1 / 2;
}

.box2 {
  grid-row: 1 / 2;
  grid-column: 2 / 3;
}

.box3 {
  grid-row: 2 / 3;
  grid-column: 1 / 2;
}

.box4 {
  grid-row: 2 / 3;
  grid-column: 2 / 3;
}
    
        </style>
            <div class=" backimage">
                <div class="background">
                    <div class="row">
                        <div class="col-md-6 left-side-a1">
                            <span class="title"> Venta </span>
                        </div>
                        <div class="col-md-6 right-side-b1">
                            <div class="bcell-data">
                                <h1 class="bcell-text"> VENTA N:</h1>
                                <h1 class="bcell-text"> FECHA: </h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 left-side-a2">
                            <span class="plastiweg">PLASTIWEG</span>
                        </div>
                        <div class="col-md-6 right-side-b2">
                            <span class="cellb2-data">CLIENTE</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 left-side-a3">
                            <span class="a3-data">Dirección: Quilpué</span>
                            <span class="a3-data">Teléfono: +569 94775180</span>
                            <span class="a3-data">veronica.ale.lago@gmail.com</span>
                            <span class="a3-data">jotalgege@gmail.com</span>
                        </div>
                        <div class="col-md-6 right-side-b3">
                            <span class="a3-data">Rut:</span>
                            <span class="a3-data">Cliente:</span>
                            <span class="a3-data">Teléfono:</span>
                            <span class="a3-data">Región:</span>
                            <span class="a3-data">Dirección:</span>
                            <span class="a3-data">Dirección de despacho:</span>
                            <span class="a3-data">Dirección de orden de compra:</span>
                            <span class="a3-data">Nombre persona de contacto:</span>
                            <span class="a3-data">Teléfono persona de contacto:</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-container">
                <div class="box1">Box 1</div>
                <div class="box2">Box 2</div>
                <div class="box3">Box 3</div>
                <div class="box4">Box 4</div>
              </div> 
    </body>
</head>