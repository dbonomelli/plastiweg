<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        .left-side-a1{
            width: 20rem;
            height: 6rem;
            border: 2px solid black;
        }
        .title{
            font-weight: bold;
            font-size: 30px;
            color: #9BBB59;
        }
        .bcell-text{
            font-size: 20px;
            font-weight: bold;
            color: black;
        }
        .right-side-b1{
            width: 24rem;
            height: 6rem;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            border-right: 2px solid black;
        }
        .left-side-a2{
            width: 20rem;
            height: 2rem;
            border-left: 2px solid black;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
        }
        .right-side-b2{
            width: 24rem;
            height: 2rem;
            background-color: #9BBB59;
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
            width: 20rem;
            height: 5rem;
            border-left: 2px solid black;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
        }
        .right-side-b3{
            width: 24rem;
            height: 5rem;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
        }
        .right-middle-left{
            text-align: left;
            width: 11.9rem;
            height: 5rem;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
        }
        .right-middle-right{
            text-align: left;
            width: 11.9rem;
            height: 5rem;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
        }
        .a3-data{
            font-size: 12px;
        }
        .a3-import{
            font-size: 12px;
            font-weight: bold;
        }
        .employee-row{
            width: 44rem;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            border-left: 2px solid black;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th{
            background-color: #9BBB59;
            color: #FFFFFF;
        }
        thead{
            text-align: center;
        }
        tbody{
            text-align: center;
        }
        table{
            border-top: 2px solid black;
        }
        th{
            font-size: 16px;
            font-weight: bold;
        }
        td{
            font-size: 13px;
        }
        th, td{
            border-left: 2px solid black;
            border-right: 2px solid black;
        }
        th:first-child,td:first-child{
            border-left: none;
        }
        th:last-child,td:last-child{
            border-right: none;
        }
        tr:nth-child(even){
            background-color: #EBF1DE;
        }
        .total{
            margin-top: 4px;
            display: table-cell;
            width: 11.3rem;
            height: 4rem;
            border-bottom: 2px solid black;
            border-right: 2px solid black;
            border-left: 2px solid black;
        }

    </style>
    <div class="flex-container" style=" margin: auto; display:table;">
        <div class="flex-item left-side-a1" style="  display:table-cell;">
            <div style="text-align: center;">
                <span class="title"> VENTA </span>
            </div>
        </div>
        <div class="flex-item right-side-b1"  style=" display:table-cell;">
            <div style="text-align: center; margin-right: 2rem; margin-top: 2rem;">
                <span class="bcell-text"> VENTA N°: {{$venta->num_venta}}</span>
            </div>
            <div style="text-align: center; margin-right: 2rem;">
                <span class="bcell-text"> FECHA: {{$venta->fecha_formateada}}</span>
            </div>
        </div>              
    </div> 
    <div class="flex-container" style=" margin: auto; display:table;">
        <div class="flex-item left-side-a2" style=" display:table-cell !important;">
            <div style="text-align: center;">
                <span class="plastiweg">PLASTIWEG</span>
            </div>
        </div>
        <div class="flex-item right-side-b2" style=" display:table-cell !important;">
            <div style="text-align: center; margin-top: 5px">
                <span class="cellb2-data">CLIENTE</span>
            </div>
        </div>
    </div>
    <!-- Tercera caja-->
    <div class="flex-container" style="margin: auto; display:table;">
        <div class="flex-item left-side-a3" style=" display:table-cell !important;">
            <div>
                <span class="a3-data">Dirección: Quilpué</span>
            </div>
            <div>
                <span class="a3-data">Teléfono: +569 94775180</span>
            </div>
            <div>
                <span class="a3-data">veronica.ale.lago@gmail.com</span>  
            </div>
            <div>
                <span class="a3-data">jotalgege@gmail.com</span>
            </div>
        </div>
        <div class="flex-item right-middle-left" style=" display:table-cell !important;">
            <div>
                <span class="a3-import">Rut:</span>
            </div>
            <div>
                <span class="a3-import">Cliente:</span>
            </div>
            @if(strlen($cliente->nombre_cliente) > 35)
            <div>
                <span ><br></span>
            </div>
            @endif
            <div>
                <span class="a3-data">Teléfono:</span>
            </div>
            <div>
                <span class="a3-data">Correo:</span>
            </div>
            <div>
                <span class="a3-data">Región:</span>
            </div>
            <div>
                <span class="a3-data">Dirección:</span>
            </div>
            @if(strlen($cliente->direccion_cliente) > 35)
            <div>
                <span ><br></span>
            </div>
            @endif
            <div>
                <span class="a3-data">Dirección de despacho:</span>
            </div>
            @if(strlen($cliente->direccion_despacho) > 35)
            <div>
                <span ><br></span>
            </div>
            @endif
            <div>
                <span class="a3-data">Dirección de orden de compra:</span>
            </div>
            <div>
                <span class="a3-data">Nombre persona de contacto:</span>
            </div>
            <div>
                <span class="a3-data">Teléfono persona de contacto:</span>
            </div>
        </div>
        <div class="flex-item right-middle-right" style=" display:table-cell !important;">
            <div>
                <span class="a3-data">{{$cliente->rut ? $cliente->rut : 'N/A' }}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->nombre_cliente ? $cliente->nombre_cliente : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->telefono_contacto_cliente ? $cliente->telefono_contacto_cliente : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->correo ? $cliente->correo : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->nombre_region ? $cliente->nombre_region : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->direccion_cliente ? $cliente->direccion_cliente : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->direccion_despacho ? $cliente->direccion_despacho : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->direccion_entrega_od ? $cliente->direccion_entrega_od : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->nombre_pers_contacto ? $cliente->nombre_pers_contacto : 'N/A'}}</span>
            </div>
            <div>
                <span class="a3-data">{{$cliente->telefono_pers_contacto ? $cliente->telefono_pers_contacto : 'N/A'}}</span>
            </div>
        </div>
    </div>
    <!-- Table seller-->
    <div class="flex-container" style=" margin: auto; display:table; margin-top: 2px">
        <div class="flex-item employee-row" style=" display:table-cell !important;">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>VENDEDOR</th>
                            <th>TRABAJO</th>
                            <th>FORMA DE PAGO</th>
                            <th>MÉTODO DE ENVÍO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$venta->nombre_vendedor}}</td>
                            <td>Bienes y Servicios</td>
                            <td>{{$venta->forma_pago_formateada}}</td>
                            <td>{{$venta->metodo_envio}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table products-->
    <div class="flex-container" style=" margin: auto; display:table; margin-top: 4px">
        <div class="flex-item employee-row" style=" display:table-cell !important;">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>CANTIDAD</th>
                            <th>DESCRIPCIÓN</th>
                            <th>PRECIO UNITARIO</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td>{{$producto->cantidad}}</td>
                            <td>{{$producto->especificaciones}}</td>
                            <td>${{$producto->valor}}</td>
                            <td>${{$producto->subtotal}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex-container" style="margin: auto; display:table; margin-top: 1px;">
        <div class="flex-item" style=" display:table-cell !important; width: 32.7rem; height: 4rem; text-align: right">
            <div>
                Neto $
            </div>
            <div>
                Iva $
            </div>
            <div>
                Cargos de Despacho $
            </div>
            <div style="font-weight: bold">
                Total $
            </div>
        </div>
        <div class="flex-item total">
            <table>
                <tbody>
                    <tr>
                        <td>${{$venta->valor_total}}</td>
                    </tr>
                    <tr>
                        <td>${{$venta->iva_total}}</td>
                    </tr>
                    <tr>
                        <td>${{$venta->cargo}}</td>
                    </tr>
                    <tr>
                        <td>${{$venta->pago_total}}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    
      
        
    
</body>
</html>