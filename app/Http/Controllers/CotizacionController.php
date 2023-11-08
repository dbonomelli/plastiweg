<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
Use PhpOffice\PhpSpreadsheet\Writer;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CsvReader;
use PhpOffice\PhpSpreadsheet\Writer\Ods;
use PhpOffice\PhpSpreadsheet\Reader\Ods as OdsReader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Border;

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
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        $excel_writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $spreadsheet->getDefaultStyle()->getFont()->setName('console');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(10);

        // Set password for readonly activesheet
        $spreadsheet->getSecurity()->setLockWindows(true);
        $spreadsheet->getSecurity()->setLockStructure(true);
        $spreadsheet->getSecurity()->setWorkbookPassword("20Plastiweg23");
        // Set password for readonly data
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getActiveSheet()->getProtection()->setPassword("20Plastiweg23");

        $spreadsheet->setActiveSheetIndex(0);
        $active_sheet = $spreadsheet->getActiveSheet();

        //data cotizacion
        $active_sheet->setCellValue('D1', $cotizacion);
        $active_sheet->setCellValue('D2', $fecha);
        $active_sheet->setCellValue('D33', $valor_total);
        $active_sheet->setCellValue('D34', $iva);
        $active_sheet->setCellValue('D35', $pago_total);

        //data cliente
        $active_sheet->setCellValue('D5', $rut);
        $active_sheet->setCellValue('D6', $nombre_cliente.' '.$apellido_cliente);
        $active_sheet->setCellValue('D7', $region);
        $active_sheet->setCellValue('D8', $direccion);
        $active_sheet->setCellValue('D9', $telefono);
        $active_sheet->setCellValue('D10', $email);

        //data VENDEDOR
        $active_sheet->setCellValue('A13', $name);
        $active_sheet->setCellValue('B13', 'Bienes y servicio');
        $active_sheet->setCellValue('C13', $fecha_venc);
        $active_sheet->setCellValue('B36', $name);

        //sql productos
        $cont = DB::select ("SELECT count(*) as contador FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion = :id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion])[0];
        $count = $cont->contador;
        $detalle = DB::select ("SELECT p.nombre_producto, dc.cantidad, p.precio_empaque, dc.subtotal FROM detalle_cotizacion dc, producto p where cotizacion_num_cotizacion =:id 
        and dc.productos_id_producto=p.id_producto;", ['id' => $cotizacion]);

        $i = 16;
        for ($j=0; $j < $count; $j++) { 
            $active_sheet->setCellValue('A' . $i, $detalle[$j]->cantidad );
            $active_sheet->setCellValue('B' . $i, $detalle[$j]->nombre_producto);
            $active_sheet->setCellValue('C' . $i, $detalle[$j]->precio_empaque);
            $active_sheet->setCellValue('D' . $i, $detalle[$j]->subtotal);
            $i++;
        }
        
        $excel_writer->save('php://output');
    }
    
}

