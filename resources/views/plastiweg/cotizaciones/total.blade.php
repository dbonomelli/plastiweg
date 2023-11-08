@extends('layout.master')

@section('title')
Plastiweb - Clientes
@endsection

<head>
    <link type="text/css" href="{{ asset('public/css/cotizacion/total.css') }}" rel="stylesheet">
</head>

@section('main')
<section class="appointment-area">
    <div class="container">
        <h3>TOTAL</h3>
        <div class="row">
            <div class="col text-right registrar">
                <a href="{{ route ('plastiweg.index') }}" class="btn btn-success">TERMINAR</a>
            </div>
        </div>

        <div class="jumbotron">
            <div class="row">
                <div class="col">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection