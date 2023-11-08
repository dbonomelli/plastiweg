<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas = DB::table('factura')->join('cliente', 'factura.cliente_id_cliente', 'cliente.id_cliente')
                        ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'factura.id_factura', 'factura.num_factura', 'factura.fecha_creacion', 'factura.monto_total', 'factura.fecha_ultimo_pago', 'factura.ultimo_pago', 'factura.pago_total_realizado' )
                        ->orderByDesc('factura.fecha_creacion')
                        ->paginate(10);

        return view('plastiweg.facturas.index', compact('facturas'));
    }

    public function indexPendientes()
    {
        $facturas = DB::table('factura')->join('cliente', 'factura.factura_id_cliente', 'cliente.id_cliente')
                        ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'factura.id_factura', 'factura.num_factura', 'factura.fecha_creacion', 'factura.monto_total', 'factura.fecha_ultimo_pago', 'factura.ultimo_pago', 'factura.pago_total_realizado' )
                        //preguntar a la tía si queiere vista con pagos pendientes de más de cierta cantidada de días
                        ->where( 'DATEDIFF((SELECT NOW()), (factura.fecha_ultimo_pago)) > 90')
                        ->orderByDesc('factura.fecha_creacion')
                        ->paginate(10);

        return view('plastiweg.facturas.index', compact('facturas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = DB::table('cliente')->orderBy('nombre_cliente', 'asc')->get();
        $ventas = DB::table('venta')->orderBy('num_venta', 'asc')->get();
        return view('plastiweg.facturas.create', compact('clientes', 'ventas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = date('Y-m-d h:m:s');

        $factura = new Factura();        
        $factura->num_factura = $request->nroFactura;
        $factura->fecha_creacion = $date;
        $factura->monto_total = $request->montoTotal;
        $factura->fecha_ultimo_pago = $date;
        $factura->ultimo_pago = $request->pagoRealizar;
        $factura->pago_total_realizado = $request->pagoRealizar;
        $factura->cliente_id_cliente = $request->cliente;
        $factura->venta_num_venta = $request->nroVenta;
        $factura->save();
        
        return redirect( route('facturas') );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        
        $facturaEdit = DB::table('factura')
                        ->join('cliente', 'cliente.id_cliente', '=', 'factura.cliente_id_cliente')
                        ->select('cliente.id_cliente', 'cliente.nombre_cliente', 'cliente.apellido_cliente', 'factura.id_factura', 'factura.num_factura', 'factura.venta_num_venta', 'factura.monto_total')
                        ->where('factura.id_factura', '=', $factura->id_factura)
                        ->get()->first(); 
         
        return view('plastiweg.facturas.edit', compact('facturaEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        $date = date('Y-m-d h:m:s');

        $total_pagado = $factura->pago_total_realizado + $request->pagoRealizar;
       
        $factura->pago_total_realizado = $total_pagado;
        $factura->fecha_ultimo_pago = $date;
        $factura->ultimo_pago = $request->pagoRealizar;
        $factura->save();

        return redirect()->route('facturas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }


    public function buscar(Request $request)
    {
        $numFactura = $request->numFactura;
        if ($numFactura) {
            
            $facturas = DB::table('factura')->join('cliente', 'factura.cliente_id_cliente', 'cliente.id_cliente')
                        ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'factura.id_factura', 'factura.num_factura', 'factura.fecha_creacion', 'factura.monto_total', 'factura.fecha_ultimo_pago', 'factura.ultimo_pago', 'factura.pago_total_realizado' )
                        ->where('factura.num_factura', '=', $numFactura)
                        ->orderByDesc('factura.fecha_creacion')
                        ->paginate(10);

            return view('plastiweg.facturas.index', compact('facturas'));
        }else{
            return redirect( route('facturas') );
        }
    }


}
