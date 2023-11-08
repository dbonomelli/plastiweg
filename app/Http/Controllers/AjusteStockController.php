<?php

namespace App\Http\Controllers;

use App\Models\AjusteStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class AjusteStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajustes = AjusteStock::join('producto', 'producto.id_producto', '=', 'producto_id_producto')
                    ->select('ajuste_stock.tipo_ajuste', 'ajuste_stock.tipo_ajuste', 'ajuste_stock.fecha_ajuste', 'ajuste_stock.cantidad_ajuste', 'ajuste_stock.motivo_ajuste', 'producto.nombre_producto')
                    ->simplePaginate(10);
        return view('plastiweg.ajuste-stock.index', compact('ajustes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = DB::select("SELECT * FROM producto");
        return view('plastiweg.ajuste-stock.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $ajusteStock = new AjusteStock();
        $ajusteStock -> tipo_ajuste             = $request -> tipo_ajuste;
        $ajusteStock -> fecha_ajuste            = date('Y-m-d H:i:s');
        $ajusteStock -> cantidad_ajuste         = $request->cantidad_ajuste;
        $ajusteStock -> motivo_ajuste           = $request->motivo_ajuste;
        $ajusteStock -> producto_id_producto    = $request->producto;
        $ajusteStock-> save();
        $id_producto = $request -> producto;
        $cantidad = $request -> cantidad_ajuste;
        
        if ($request->tipo_ajuste == 1) {
            DB::update('update producto set stock_empaques = (stock_empaques + :cantidad) where id_producto =  :id_producto', ['cantidad' => $cantidad, 'id_producto' => $id_producto]);
        }else{
            DB::update('update producto set stock_empaques = (stock_empaques - :cantidad) where id_producto =  :id_producto', ['cantidad' => $cantidad, 'id_producto' => $id_producto]);
        }
        return redirect( route('ajuste'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function show(AjusteStock $ajusteStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function edit(AjusteStock $ajusteStock)
    {
        return view('plastiweg.ajuste-stock.edit', compact('ajusteStock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjusteStock $ajusteStock)
    {
        if (($request -> tipo_ajuste) != 0 and ($request -> motivo_ajuste) != 0) {
            
            if ($ajusteStock->tipo_ajuste=='1') {
                //si era ingreso se debe volver al stock anterior restandolo para dejar el stock original
                DB::update('update producto set stock_empaques = (stock_empaques - :cantidad) where id_producto =  :id_producto', ['cantidad' => $ajusteStock -> cantidad_ajuste, 'id_producto' => $ajusteStock->producto_id_producto]);
            }else{
                //si era egreso se debe sumar la cantidad al stock para dejar el stock original
                 DB::update('update producto set stock_empaques = (stock_empaques + :cantidad) where id_producto =  :id_producto', ['cantidad' => $ajusteStock -> cantidad_ajuste, 'id_producto' => $ajusteStock->producto_id_producto]);
            }
            $ajusteStock -> tipo_ajuste             = $request -> tipo_ajuste;
            $ajusteStock -> fecha_ajuste            = date('Y-m-d H:i:s');
            $ajusteStock -> cantidad_ajuste         = $request -> cantidad_ajuste;
            $ajusteStock -> motivo_ajuste           = $request -> motivo_ajuste;
            $ajusteStock -> producto_id_producto    = $request -> producto;
            $ajusteStock-> save();
            
            $id_producto = $request -> producto;
            $cantidad = $request -> cantidad_ajuste;
            
            if (($request -> tipo_ajuste) == 1) {
                DB::update('update producto set stock_empaques = (stock_empaques + :cantidad) where id_producto =  :id_producto', ['cantidad' => $cantidad, 'id_producto' => $id_producto]);
            }else{
                DB::update('update producto set stock_empaques = (stock_empaques - :cantidad) where id_producto =  :id_producto', ['cantidad' => $cantidad, 'id_producto' => $id_producto]);
            }
            return redirect( route('ajuste'));
        }else{
            return view('plastiweg.ajuste-stock.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AjusteStock  $ajusteStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjusteStock $ajusteStock)
    {
        //
    }
}
