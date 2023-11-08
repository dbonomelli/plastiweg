<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $cotizacion = $request->cotizacion;
        $venta = $request->venta;

        // copiar detalles cotizacion a detalles venta
        $detalles = DB::select("SELECT * FROM detalle_cotizacion where cotizacion_num_cotizacion=:id", ['id' => $cotizacion]);
        $cont = DB::select ("SELECT count(*) as contador FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion = :id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion])[0];
        $count = $cont->contador;
        for ($j=0; $j < $count; $j++) { 
            //producto repetido en venta
            $existe = DB::select("SELECT * FROM detalle_venta where venta_num_venta=:id and producto_id_producto=:id_prod",['id' => $venta, 'id_prod' => $detalles[$j]->productos_id_producto]);
            if($existe){
                break;
            }else{
                $detalles_v = new DetalleVenta();
                $detalles_v->venta_num_venta           = (int)$venta;
                $detalles_v->producto_id_producto      = $detalles[$j]->productos_id_producto;
                $detalles_v->cantidad                  = $detalles[$j]->cantidad;
                $detalles_v->descuento                 = $detalles[$j]->descuento;
                $detalles_v->valor                     = $detalles[$j]->valor;
                $detalles_v->iva                       = $detalles[$j]->iva  ;
                $detalles_v->subtotal                  = $detalles[$j]->subtotal;
                $detalles_v->save();
                //restar stock inventario
                DB::update('update producto set stock_empaques = (stock_empaques - :cantidad) where id_producto =  :id_producto', ['cantidad' => $detalles[$j]->cantidad, 'id_producto' => $detalles[$j]->productos_id_producto]);
            }
        }

        //redireccionar totalventas para emitir excel 
        $cliente   = DB::select("SELECT cli.rut, cli.nombre_cliente, cli.apellido_cliente, cli.telefono_contacto_cliente, cli.direccion_cliente, cli.correo, cli.Comuna_idComuna 
        FROM cliente cli, venta ve, cotizacion co
        where ve.num_venta=:id and cli.id_cliente=co.cliente_id_cliente and co.num_cotizacion=:co",['id' => $venta, 'co' => $cotizacion])[0];

        $sql_fec = DB::select(" SELECT fecha_emision, valor_total, pago_total, iva_total 
        FROM venta  
        where num_venta=:id", ['id' => $venta])[0];
        $fecha = $sql_fec->fecha_emision;
        $valor_total = $sql_fec->valor_total;
        $pago_total = $sql_fec->pago_total;
        $iva_total = $sql_fec->iva_total;
        
        $detalles = DB::select ("SELECT p.nombre_producto, dc.cantidad, dc.subtotal 
        FROM detalle_venta dc, producto p 
        where venta_num_venta =:id and dc.producto_id_producto=p.id_producto;", ['id' => $venta]);


        return view('plastiweg.ventas.totalventa', compact('venta', 'cliente', 'fecha', 'valor_total', 'detalles', 'pago_total', 'iva_total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleVenta $detalleVenta)
    {
        //
    }
}
