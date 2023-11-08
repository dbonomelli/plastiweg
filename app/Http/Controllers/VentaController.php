<?php

namespace App\Http\Controllers;

use App\Exports\VentasExport;
use App\Models\Venta;
use App\Models\Cotizacion;
use App\Models\DetalleVenta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     * listado de ventas en informes
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::paginate(10);
        return view('plastiweg.ventas.index', compact('ventas'));
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
        //get numero cotizacion
        $cotizacion = $request -> cotizacion;
        //get numero cotizacion
        $cliente_id = $request -> cliente;
        //get numero orden de compra
        $od = $request -> od;
        //get metodo envio
        $met= $request -> despacho;
        //get cargo 
        $cargo=$request -> cargo;
        //get forma de pago
        $form=$request -> pago;
        //fecha de emision
        $date = date('Y-m-d h:m:s');
        //id del vendedor
        $vendedor_id= '1';
        $sql=DB::select ("SELECT * FROM cotizacion where num_cotizacion = :id", ['id' => $cotizacion])[0];
        //valor_total
        $val=  $sql->valor_total;
        //descuento
        $desc= $sql->descuento_total;
        //iva
        $iva= $sql->iva_total;
        //pago total
        $tot=$val+$cargo+$iva;

        $venta = new Venta();
        $venta->unidad_compra      = '1'; 
        $venta->metodo_despacho    = $met; 
        $venta->fecha_emision      = $date;           
        $venta->forma_pago         = $form;      
        $venta->cargo              = $cargo;                
        $venta->estado             = 'A';             
        $venta->descuento_total    = $desc;              
        $venta->valor_total        = $val;               
        $venta->iva_total          = $iva;      
        $venta->pago_total         = $tot;  
        $venta->cliente_id_cliente = $sql->cliente_id_cliente;
        $venta->numero_orden_de_compra = $od;                
        $venta->cotizacion_num_cotizacion = $cotizacion;                
        $venta->save();

        //update cotizacion
        $estado ='A';
        DB::table('cotizacion')
        ->where('num_cotizacion', $cotizacion)
        ->update(['estado' => $estado]);

        $sql_vent=DB::select ("SELECT num_venta FROM venta where cotizacion_num_cotizacion=:id", ['id' => $cotizacion])[0];
        $venta=  $sql_vent->num_venta;

        return redirect()->route('detallesventas.store', ['cotizacion' => $cotizacion, 'venta'=>$venta]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        $productos = DB::select("SELECT d.*, p.nombre_producto FROM detalle_venta d INNER JOIN producto p ON p.id_producto = d.producto_id_producto WHERE d.venta_num_venta = :id", ['id' => $venta->num_venta]);
        $cliente = DB::table('cliente')
                            ->join('cotizacion', 'cliente.id_cliente', 'cotizacion.cliente_id_cliente')
                            ->join('venta', 'cotizacion.num_cotizacion', 'venta.cotizacion_num_cotizacion')
                            ->where('venta.num_venta', '=', $venta->num_venta)
                            ->first();
        return view('plastiweg.ventas.detalleVenta', compact('venta', 'productos', 'cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Actualizacion de estado aceptado a entregado
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        $venta->estado = 'E';
        $venta->save();
        $productos = DB::select("SELECT d.*, p.nombre_producto FROM detalle_venta d INNER JOIN producto p ON p.id_producto = d.producto_id_producto WHERE d.venta_num_venta = :id", ['id' => $venta->num_venta]);
        $cliente = DB::table('cliente')
                            ->join('cotizacion', 'cliente.id_cliente', 'cotizacion.cliente_id_cliente')
                            ->join('venta', 'cotizacion.num_cotizacion', 'venta.cotizacion_num_cotizacion')
                            ->where('venta.num_venta', '=', $venta->num_venta)
                            ->first();
        return view('plastiweg.ventas.detalleVenta', compact('venta', 'productos', 'cliente'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }

    // pagina principal de informes
    public function informes()
    {
        return view('plastiweg.informes.index');
    }

    public function detalleProd()
    {
        return view('plastiweg.ventas.productosVenta');
    }

    // busqueda de alguna venta realizada
    public function buscar(Request $request)
    {
        $venta = $request->num_venta;
        if ($venta) {
            $ventas = Venta::where('num_venta', '=', "{$venta}")->paginate(10);
            return view('plastiweg.ventas.index', compact('ventas'));
        }else{
            return redirect( route('ventas') );
        } 
    }

    public function rechazar(Request $request)
    {
        $cotizacion = $request->num_cotizacion;
        $estado ='R';

        DB::table('cotizacion')
        ->where('num_cotizacion', $cotizacion)
        ->update(['estado' => $estado]);
        
        $cotizaciones = DB::select("SELECT cli.nombre_cliente, cli.apellido_cliente, cot.num_cotizacion, cot.fecha_emision, cot.estado, cot.pago_total  FROM cliente cli, cotizacion cot  where cot.cliente_id_cliente=cli.id_cliente  and cot.estado='p' order by fecha_emision desc");

        return view('plastiweg.cotizaciones.SeguirCotizacion', compact('cotizaciones'));
    }

    public function aceptar(Request $request)
    {
        $cotizacion = $request->num_cotizacion;
        $cliente   = DB::select("SELECT * FROM cliente cli, cotizacion co where co.num_cotizacion=:id and cli.id_cliente=co.cliente_id_cliente",['id' => $cotizacion])[0];
        $id_cliente = $cliente -> id_cliente;
        $sql_dir = DB::select("SELECT c.nombre_comuna, r.nombre_region FROM cliente cli, comuna c, region r where cli.id_cliente=:id and cli.Comuna_idComuna=c.id_comuna and c.region_id_region=r.id_region",['id' => $id_cliente])[0];
        $comuna = $sql_dir->nombre_comuna;
        $region = $sql_dir->nombre_region;
        return view('plastiweg.ventas.create', compact('cotizacion', 'cliente', 'region', 'comuna'));
    }

    public function export(Request $request){
        //Listado de productos
        $productos = DB::select("SELECT d.*, p.nombre_producto, p.especificaciones FROM detalle_venta d INNER JOIN producto p ON p.id_producto = d.producto_id_producto WHERE d.venta_num_venta = :id", ['id' => $request->num_venta]);
        //Datos cliente
        $cliente = DB::table('cliente')
                            ->join('cotizacion', 'cliente.id_cliente', 'cotizacion.cliente_id_cliente')
                            ->join('venta', 'cotizacion.num_cotizacion', 'venta.cotizacion_num_cotizacion')
                            ->join('comuna', 'cliente.Comuna_idComuna', 'comuna.id_comuna')
                            ->join('region', 'region.id_region', 'comuna.region_id_region')
                            ->where('venta.num_venta', '=', $request->num_venta)
                            ->first();
        //Datos Venta
        $venta = DB::table('venta')
                            ->where('venta.num_venta', '=', $request->num_venta)
                            ->first();
        #dd(strlen($cliente->direccion_cliente));
        $venta->nombre_vendedor = 'Juan González';
        //Fecha formateada
        $fecha = $venta->fecha_emision;
        $fecha   = date("d/m/Y", strtotime($fecha));
        $venta->fecha_formateada = $fecha;
        //Forma de pago
        if($venta->forma_pago=='1'){
            $forma_pago = 'Contado';
        }elseif ($venta->forma_pago=='2'){
            $forma_pago = 'Credito a 30 dias';
        }else{
            $forma_pago = 'Credito a 60 dias';
        }
        $venta->forma_pago_formateada = $forma_pago;
        //Método de envío
        if($venta->metodo_despacho=='1'){
            $metodo_envio = 'Despacho';
        }else{
            $metodo_envio = 'Retiro local';
        }
        $venta->metodo_envio = $metodo_envio;

        //debug
        return view('plastiweg.ventas.invoice', compact(['productos', 'cliente', 'venta']));

        //Descargar PDF
        $view = View::make('plastiweg.ventas.invoice', compact(['productos', 'cliente', 'venta']))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf = Pdf::loadHTML($view);
        $fecha_actual = Carbon::now();
        $fecha_actual = date('d-m-Y',strtotime($fecha_actual));
        $pdf_name = 'Venta_'.$request->num_venta.'_'.$fecha_actual.'.pdf';
        return $pdf->download($pdf_name);
    }

}
