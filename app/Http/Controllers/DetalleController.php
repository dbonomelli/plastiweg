<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Detalle;
use App\Models\Cotizacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //recibe el request de cotizaciones controller
        $cotizacion = $request->num;
        // $cotizacionAux = $cotizacion->num_cotizacion[0];
        // dd($request);
        $detalle = DB::table('detalle_cotizacion')
                        ->join('producto', 'detalle_cotizacion.productos_id_producto', '=', 'producto.id_producto')
                        ->select('detalle_cotizacion.cantidad', 'detalle_cotizacion.valor', 'detalle_cotizacion.descuento', 
                                    'detalle_cotizacion.subtotal','producto.nombre_producto', 'producto.codigo_producto')
                        ->where('detalle_cotizacion.cotizacion_num_cotizacion', '=', $cotizacion)
                        ->get();
        // DB::select ("SELECT p.nombre_producto, p.codigo_producto, dc.cantidad, dc.valor, dc.descuento, dc.subtotal 
        //                         FROM plastiweb.detalle_cotizacion dc, plastiweb.producto p 
        //                         where cotizacion_num_cotizacion = :id 
        //                         and dc.productos_id_producto = p.id_producto;", ['id' => $cotizacion]);
        
        
        $cotiza = DB::table('cotizacion')
                    ->where('cotizacion.num_cotizacion', '=', $cotizacion)
                    ->first();
        // COTIZACION::find($cotizacion);
        $valor_total = $cotiza->pago_total;
        

        return view('plastiweg.detalles_cotizaciones.index', compact('cotizacion', 'detalle', 'valor_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $productos = DB::select("SELECT * FROM producto WHERE deleted_at == null");
        $productos = Producto::all();
        return view('plastiweg.detalles_cotizaciones.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cotizacion= $request -> cotizacion;
        
        try {
            $id        = $request -> id_producto;
            $cantidad  = $request -> cantidad;
            $sql_valor = DB::select("SELECT precio_empaque FROM producto where id_producto = :id", ['id' => $id])[0];
            $valor     = $sql_valor->precio_empaque;
            $descuento = $request -> descuento;
            $precio = $cantidad * $valor;
            // Si existe el descuento anterior
            if ($descuento != 0) {
                $subtotal = ($cantidad * $valor) - $descuento;
            } else {
                // Se asigna solamente el precio a mensaje 
                $subtotal  = $precio;
            }
            $iva = $subtotal * 0.19;
            //producto repetido en cotizacion
            $existe = DB::select("SELECT * FROM detalle_cotizacion where cotizacion_num_cotizacion=:id and productos_id_producto=:id_prod",['id' => $cotizacion, 'id_prod' => $id]);
            if($existe){

                DB::update("UPDATE detalle_cotizacion SET cantidad = :cant, subtotal = :sub, descuento = :descuento where cotizacion_num_cotizacion=:id and productos_id_producto=:id_prod", 
                ['id' => $cotizacion, 'id_prod' => $id, 'cant'=> $cantidad, 'sub' => $subtotal, 'descuento'=>$descuento]);
            }else{
                $detalle = new Detalle();
                $detalle->cotizacion_num_cotizacion = (int)$cotizacion;
                $detalle->productos_id_producto     = $id;
                $detalle->cantidad                  = (int)$cantidad;
                $detalle->descuento                 = (int)$descuento;
                $detalle->valor                     = (int)$valor;
                $detalle->iva                       = (int)$iva;
                $detalle->subtotal                  = (int)$subtotal;
                $detalle->save();
                $neto = $subtotal - $iva;

                DB::update("UPDATE cotizacion SET valor_total = valor_total + :neto, iva_total = iva_total + :iva, pago_total = pago_total + :sub where num_cotizacion = :id", ['id' => $cotizacion, 'neto' => $neto, 'iva'=> $iva, 'sub' => $subtotal]);
            }

            $detalle = DB::select ("SELECT dc.descuento, p.nombre_producto, p.codigo_producto, dc.cantidad, dc.valor, dc.subtotal FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion = :id 
            and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion]);

            $sql_val = DB::select ("SELECT pago_total FROM cotizacion where num_cotizacion = :id", ['id' => $cotizacion])[0];
            $valor_total = $sql_val->pago_total;

            return view('plastiweg.detalles_cotizaciones.index', compact('cotizacion', 'detalle', 'valor_total'));
        } catch (\Throwable $th) {
            $detalle = DB::table('detalle_cotizacion')
                        ->join('producto', 'detalle_cotizacion.productos_id_producto', '=', 'producto.id_producto')
                        ->select('detalle_cotizacion.cantidad', 'detalle_cotizacion.valor', 'detalle_cotizacion.descuento', 
                                    'detalle_cotizacion.subtotal','producto.nombre_producto', 'producto.codigo_producto')
                        ->where('detalle_cotizacion.cotizacion_num_cotizacion', '=', $cotizacion)
                        ->get();
        
            
            $cotiza = DB::table('cotizacion')
                        ->where('cotizacion.num_cotizacion', '=', $cotizacion)
                        ->first();
            $valor_total = $cotiza->pago_total;
            return view('plastiweg.detalles_cotizaciones.index', compact('cotizacion', 'detalle', 'valor_total'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function show(Detalle $detalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Detalle $detalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalle $detalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detalle $detalle)
    {
        //
    }

    public function consultarcotizacion()
    {
        return view('plastiweg.cotizaciones.ConsultarCotizacion');
    } 

    public function cancelar(Request $request)
    {
        // get cod
        $cotizacion = $request->cotizacion;
        $cont = DB::select ("SELECT count(*) as contador FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion = :id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion])[0];
         $count = $cont->contador;
        //if existe productos asociados a la cotizacion
        if ($count>0){
            DB::table('detalle_cotizacion')->where('cotizacion_num_cotizacion', '=', $cotizacion)->delete();
        }
        DB::table('cotizacion')->where('num_cotizacion', '=', $cotizacion)->delete();

        return redirect( route("cotizaciones.create"));
    }

    public function borrar(Request $request)
    {
        
        $cotizacion = $request->cotizacion;
        $codigo_producto   = $request->producto;
        $sql_producto=DB::select ("SELECT * FROM producto where codigo_producto=:cod;", ['cod' => $codigo_producto])[0];
        $num_prod = $sql_producto->id_producto;

        $producto_eliminado = DETALLE::where('cotizacion_num_cotizacion', '=', $cotizacion)->where('productos_id_producto', '=', $num_prod)->get();
        
        DB::table('detalle_cotizacion')->where('cotizacion_num_cotizacion', '=', $cotizacion)->where('productos_id_producto', '=', $num_prod)->delete();

        $detalles_productos = DETALLE::where('cotizacion_num_cotizacion', '=', $cotizacion)->get();
        
        $subtotal_detalle = 0;
        foreach ($detalles_productos as $detalle) {
            $subtotal_detalle = $subtotal_detalle + $detalle->subtotal;
        }
        $iva_detalle = $subtotal_detalle * 0.19;
        $neto_detalle = $subtotal_detalle - $iva_detalle;
        
        DB::update("UPDATE cotizacion SET valor_total = :neto, iva_total = :iva, pago_total = :sub 
                    where num_cotizacion = :id", ['id' => $cotizacion, 'neto' => $neto_detalle, 'iva' => $iva_detalle, 'sub' => $subtotal_detalle]);
        
        $detalle = DB::select ("SELECT p.nombre_producto, p.codigo_producto, dc.cantidad, dc.valor, dc.subtotal, dc.descuento 
                                FROM detalle_cotizacion dc, producto p 
                                where cotizacion_num_cotizacion = :id and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion]);

        $sql_val = DB::select ("SELECT valor_total FROM cotizacion where num_cotizacion = :id", ['id' => $cotizacion])[0];
        $valor_total = $sql_val->valor_total;

        $cotiza = COTIZACION::find($cotizacion);
        $cliente_id = $cotiza->cliente_id_cliente;

        $data= array('num'=>$cotizacion, 'client_id'=>$cliente_id);
        return redirect( route('detalles.index', $data));
    }

}
