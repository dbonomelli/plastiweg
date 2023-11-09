<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('plastiweg.cotizaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $clientes = DB::table('cliente')->orderBy('nombre_cliente', 'asc')->get();
        return view('plastiweg.cotizaciones.SeleccionCliente', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //id del cliente
        $cliente_id= $request -> cliente;
        //fecha de emision
        $date = date('Y-m-d H:i:s');
        //id del vendedor
        $vendedor_id= '1';

        //insert en la BD
        $cotizacion = new Cotizacion();
        $cotizacion->unidad_compra      = '1'; 
        $cotizacion->metodo_despacho    = '0'; 
        $cotizacion->fecha_emision      = $date;           
        $cotizacion->forma_pago         = '0';      
        $cotizacion->cargo              = '0';                
        $cotizacion->estado             = 'P';             
        $cotizacion->descuento_total    = 0;              
        $cotizacion->valor_total        = 0;               
        $cotizacion->iva_total          = 0;      
        $cotizacion->pago_total         = 0;        
        $cotizacion->vendedor_id_vendedor = $vendedor_id;                
        $cotizacion->cliente_id_cliente = $cliente_id;                

        $cotizacion->save();

        //recuperar el numero de la cotizacon
        $sql =DB::table('cotizacion')->select('num_cotizacion')->where('fecha_emision', '=', $date)->where('cliente_id_cliente', '=', $cliente_id)->first();
        
        $code = $sql->num_cotizacion;
        $data= array('num'=>$code, 'client_id'=>$cliente_id);
        return redirect( route('detalles.index', $data));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizacion $cotizacion)
    {
        $productos = DB::select("SELECT d.*, p.nombre_producto FROM detalle_cotizacion d INNER JOIN producto p ON p.id_producto = d.productos_id_producto WHERE d.cotizacion_num_cotizacion = :id", ['id' => $cotizacion->num_cotizacion]);
        return view('plastiweg.cotizaciones.detalleCotizacion', compact('cotizacion', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacion $cotizacion)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }

    public function seleccionclientes()
    {
        return redirect( route('cotizaciones.clientes'));
    } 

    //envio data cotizacion final
    public function totalproductos(Request $request)
    {
        $cotizacion = $request->cotizacion;
        $sql_cli = DB::select("SELECT cli.nombre_cliente, cli.apellido_cliente FROM cliente cli, cotizacion cot  where cot.cliente_id_cliente=cli.id_cliente and cot.num_cotizacion=:id", ['id' => $cotizacion])[0];
        $nom=$sql_cli->nombre_cliente;
        $ape=$sql_cli->apellido_cliente;
        $nombre_cliente = $nom.' '.$ape;
        $sql_cot = DB::select(" SELECT fecha_emision, pago_total, iva_total, valor_total FROM cotizacion  where num_cotizacion=:id", ['id' => $cotizacion])[0];
        $fecha = $sql_cot->fecha_emision;
        $valor_total = $sql_cot->valor_total;
        $pago_total = $sql_cot->pago_total;
        $iva_total = $sql_cot->iva_total;
        $detalle = DB::select ("SELECT p.nombre_producto, p.precio_empaque, dc.cantidad, dc.subtotal FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion =:id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion]);

        return view('plastiweg.cotizaciones.TotalProductos', compact('cotizacion', 'nombre_cliente', 'fecha', 'valor_total', 'detalle', 'pago_total', 'iva_total'));
    } 

    public function seguircotizacion()
    {
        $cotizaciones = DB::table('cotizacion')->join('cliente', 'cotizacion.cliente_id_cliente', 'cliente.id_cliente')
                        ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'cotizacion.num_cotizacion', 'cotizacion.fecha_emision', 'cotizacion.estado', 'cotizacion.pago_total')
                        ->where('cotizacion.estado', '=', 'p')
                        ->orderByDesc('cotizacion.fecha_emision')
                        ->paginate(10);

        return view('plastiweg.cotizaciones.SeguirCotizacion', compact('cotizaciones'));
    } 
    
    public function buscarSeguimientoCotizacion(Request $request)
    {
        $nom_cliente = $request->nom_cliente;
        if ($nom_cliente) {
            $cotizaciones = DB::table('cotizacion')->join('cliente', 'cotizacion.cliente_id_cliente', 'cliente.id_cliente')
                                ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'cotizacion.num_cotizacion', 'cotizacion.fecha_emision', 'cotizacion.estado', 'cotizacion.pago_total')
                                ->where('cotizacion.estado', '=', 'p')
                                ->where('cliente.nombre_cliente', 'like', '%'.$nom_cliente.'%')
                                ->orderByDesc('cotizacion.fecha_emision')
                                ->paginate(10);
            return view('plastiweg.cotizaciones.ConsultarCotizacion', compact('cotizaciones'));
        }else{
            return redirect( route('cotizaciones.consulta') );
        }
    }

    public function consultarcotizacion()
    {
        $cotizaciones = DB::table('cotizacion')->join('cliente', 'cotizacion.cliente_id_cliente', 'cliente.id_cliente')
                            ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'cotizacion.num_cotizacion', 'cotizacion.fecha_emision', 'cotizacion.estado', 'cotizacion.pago_total')
                            ->where('cotizacion.estado', '=', 'p')
                            ->orderByDesc('cotizacion.fecha_emision')
                            ->paginate(10);

        return view('plastiweg.cotizaciones.ConsultarCotizacion', compact('cotizaciones'));
    } 

    public function buscar(Request $request)
    {
        $nom_cliente = $request->nom_cliente;
        if ($nom_cliente) {
            $cotizaciones = DB::table('cotizacion')->join('cliente', 'cotizacion.cliente_id_cliente', 'cliente.id_cliente')
                            ->select('cliente.nombre_cliente', 'cliente.apellido_cliente', 'cotizacion.num_cotizacion', 'cotizacion.fecha_emision', 'cotizacion.estado', 'cotizacion.pago_total')
                            ->where('cotizacion.estado', '=', 'p')
                            ->where('cliente.nombre_cliente', 'like', '%'.$nom_cliente.'%')
                            ->orderByDesc('cotizacion.fecha_emision')
                            ->paginate(10);
            return view('plastiweg.cotizaciones.ConsultarCotizacion', compact('cotizaciones'));
        }else{
            return redirect( route('cotizaciones.consulta') );
        }
    }

    public function Listado()
    {
        $cotizaciones = COTIZACION::paginate(10);
        return view('plastiweg.informes.cotizacion', compact('cotizaciones'));
    } 

    public function informesBuscar(Request $request)
    {
        $num = $request->num_cot;
        if ($num) {
            $cotizaciones = DB::table('cotizacion')
                            ->select('cotizacion.num_cotizacion', 'cotizacion.fecha_emision', 'cotizacion.estado', 'cotizacion.pago_total')
                            ->where('cotizacion.num_cotizacion', '=', $num)
                            ->paginate(1);
            return view('plastiweg.informes.cotizacion', compact('cotizaciones'));
        }else{
            return redirect( route('informes.cotizaciones') );
        }
    }

    public function volver(Request $request){
        // get cod
        $cotizacion = $request->cotizacion;
        $sql_val = DB::select ("SELECT pago_total FROM cotizacion where num_cotizacion = :id", ['id' => $cotizacion])[0];
        $valor_total = $sql_val->pago_total;
        $detalle = DB::select ("SELECT p.codigo_producto, p.nombre_producto, dc.cantidad, dc.subtotal, dc.valor, dc.descuento FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion =:id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion]);

        return view('plastiweg.detalles_cotizaciones.index', compact('cotizacion', 'detalle', 'valor_total'));
    }

    public function descarga(Request $request)
    {       
        // get cod
        $cotizacion = $request->cotizacion;
        
        //cotizacion
        $sql_cot = DB::select("SELECT fecha_emision, estado, forma_pago, valor_total, pago_total, iva_total FROM cotizacion where num_cotizacion = :num", ['num' => $cotizacion])[0];
        $fec     = $sql_cot->fecha_emision;
        $fecha   = date("d/m/Y", strtotime($fec));
        $fecha_venc = date("d/m/Y",strtotime($fec."+ 30 days")); 
        $valor_total=$sql_cot->valor_total;
        $pago_total=$sql_cot->pago_total;
        $iva=$sql_cot->iva_total;
        //cliente
        $sql_cli = DB::select("SELECT cli.rut, cli.nombre_cliente, cli.apellido_cliente, cli.telefono_contacto_cliente, cli.direccion_cliente, cli.correo, r.nombre_region, c.nombre_comuna  
                            FROM cliente cli, cotizacion cot, comuna c, region r 
                            where cot.cliente_id_cliente=cli.id_cliente and cot.num_cotizacion=:id 
                            and cli.Comuna_idComuna=c.id_comuna and c.region_id_region=r.id_region", ['id' => $cotizacion])[0];
        $rut   =$sql_cli->rut;
        $nombre_cliente   =$sql_cli->nombre_cliente;
        $apellido_cliente =$sql_cli->apellido_cliente;
        $telefono  =$sql_cli->telefono_contacto_cliente;
        $dir =$sql_cli->direccion_cliente;
        $region =$sql_cli->nombre_region;
        $com =$sql_cli->nombre_comuna;
        $email     =$sql_cli->correo;
        $direccion = $com.','.$dir;

        //vendedor
        $sql_ven = DB::select("SELECT v.nombre_vendedor, v.apellido_vendedor FROM vendedor v , cotizacion c where c.num_cotizacion = :id and c.vendedor_id_vendedor = v.id_vendedor;", ['id' => $cotizacion])[0];
        $nombre_vendedor=$sql_ven->nombre_vendedor;
        $apellido_vendedor=$sql_ven->apellido_vendedor;
        $name = 'Juan González';
        
        //EXCEL
        $strFilename=sprintf('%s_%s_cotizacion', date('d-m-Y'), $cotizacion);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$strFilename.'.xlsx"');
        header('Cache-Control: max-age=0');
        
        //dd($sql_ven);
        
        $inputFileName = './img/plantillas/plantilla_cotizacion.xlsx';
        //$spreadsheet = new Spreadsheet();
        #$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        #$excel_writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        #$spreadsheet->getDefaultStyle()->getFont()->setName('console');
        #$spreadsheet->getDefaultStyle()->getFont()->setSize(10);

        // Set password for readonly activesheet
        #$spreadsheet->getSecurity()->setLockWindows(true);
        #$spreadsheet->getSecurity()->setLockStructure(true);
        #$spreadsheet->getSecurity()->setWorkbookPassword("20Plastiweg23");
        // Set password for readonly data
        #$spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        #$spreadsheet->getActiveSheet()->getProtection()->setPassword("20Plastiweg23");

        #$spreadsheet->setActiveSheetIndex(0);
        #$active_sheet = $spreadsheet->getActiveSheet();

        //data cotizacion
        #$active_sheet->setCellValue('D1', $cotizacion);
        #$active_sheet->setCellValue('D2', $fecha);
        #$active_sheet->setCellValue('D33', $valor_total);
        #$active_sheet->setCellValue('D34', $iva);
        #$active_sheet->setCellValue('D35', $pago_total);

        //data cliente
        #$active_sheet->setCellValue('D5', $rut);
        #$active_sheet->setCellValue('D6', $nombre_cliente.' '.$apellido_cliente);
        #$active_sheet->setCellValue('D7', $region);
        #$active_sheet->setCellValue('D8', $direccion);
        #$active_sheet->setCellValue('D9', $telefono);
        #$active_sheet->setCellValue('D10', $email);

        //data VENDEDOR
        #$active_sheet->setCellValue('A13', $name);
        #$active_sheet->setCellValue('B13', 'Bienes y servicio');
        #$active_sheet->setCellValue('C13', $fecha_venc);
        #$active_sheet->setCellValue('B36', $name);

        //sql productos
        $cont = DB::select ("SELECT count(*) as contador FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion = :id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion])[0];
        $count = $cont->contador;
        $detalle = DB::select ("SELECT p.nombre_producto, dc.cantidad, p.precio_empaque, dc.subtotal FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion =:id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion]);

        $i = 16;
        for ($j=0; $j < $count; $j++) { 
            #$active_sheet->setCellValue('A' . $i, $detalle[$j]->cantidad );
            #$active_sheet->setCellValue('B' . $i, $detalle[$j]->nombre_producto);
            #$active_sheet->setCellValue('C' . $i, $detalle[$j]->precio_empaque);
            #$active_sheet->setCellValue('D' . $i, $detalle[$j]->subtotal);
            $i++;
        }
        
        #$excel_writer->save('php://output');
    }

    public function export(Request $request){
        //Listado de productos
        $productos = DB::select("SELECT d.*, p.nombre_producto, p.especificaciones FROM detalle_cotizacion d INNER JOIN producto p ON p.id_producto = d.productos_id_producto WHERE d.cotizacion_num_cotizacion = :id", ['id' => $request->cotizacion]);
        #dd($productos);
        //Datos cliente
        $cliente = DB::table('cliente')
                            ->join('cotizacion', 'cliente.id_cliente', 'cotizacion.cliente_id_cliente')
                            ->join('comuna', 'cliente.Comuna_idComuna', 'comuna.id_comuna')
                            ->join('region', 'region.id_region', 'comuna.region_id_region')
                            ->where('cotizacion.num_cotizacion', '=', $request->cotizacion)
                            ->first();
        #dd($cliente);
        //Datos cotizacion
        $cotizacion = DB::table('cotizacion')
                            ->where('cotizacion.num_cotizacion', '=', $request->cotizacion)
                            ->first();
        #dd(strlen($cliente->direccion_cliente));
        $cotizacion->nombre_vendedor = 'Juan González';
        //Fecha formateada
        $fecha = $cotizacion->fecha_emision;
        $fecha   = date("d/m/Y", strtotime($fecha));
        $cotizacion->fecha_formateada = $fecha;
        //Forma de pago
        if($cotizacion->forma_pago=='1'){
            $forma_pago = 'Contado';
        }elseif ($cotizacion->forma_pago=='2'){
            $forma_pago = 'Credito a 30 dias';
        }else{
            $forma_pago = 'Credito a 60 dias';
        }
        $cotizacion->forma_pago_formateada = $forma_pago;
        //Método de envío
        if($cotizacion->metodo_despacho=='1'){
            $metodo_envio = 'Despacho';
        }else{
            $metodo_envio = 'Retiro local';
        }
        $cotizacion->metodo_envio = $metodo_envio;

        #dd($cotizacion);
        //debug
        #return view('plastiweg.cotizaciones.invoice', compact(['productos', 'cliente', 'cotizacion']));

        //Descargar PDF
        $view = View::make('plastiweg.cotizaciones.invoice', compact(['productos', 'cliente', 'cotizacion']))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf = Pdf::loadHTML($view);
        $fecha_actual = Carbon::now();
        $fecha_actual = date('d-m-Y',strtotime($fecha_actual));
        $pdf_name = 'Cotizacion_'.$request->cotizacion.'_'.$fecha_actual.'.pdf';
        return $pdf->download($pdf_name);
    }

    public static function getImage(){
        return 'data:image/png;base64,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';
    }
    
}

