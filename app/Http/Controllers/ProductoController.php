<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['indexGuest', 'buscarGuest']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(6);
        return view('plastiweg.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plastiweg.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();

            $prod = $request -> nombre_producto;
            $prod_rep = DB::select("SELECT * FROM producto where nombre_producto = :prod", ['prod' => $prod]);
            $prod_rep2 = DB::select("SELECT * FROM producto where codigo_producto = :cod", ['cod' => $request -> codigo_producto]);
            if ($prod_rep or $prod_rep2) {
                return redirect( route('productos.inventario'));
            }else{
                $nom = $request -> nombre_producto;
                $producto -> nombre_producto                = strtoupper($nom);
                $producto -> codigo_producto                = strtoupper($request -> codigo_producto);
                $producto -> contenido_unidades_por_empaque = $request -> contenido_unidades_por_empaque;
                $producto -> precio_empaque                 = $request -> precio_empaque;
                $producto -> stock_empaques                 = $request -> stock_empaques;
                $producto -> stock_critico_empaques         = $request -> stock_critico_empaques;
                $producto -> especificaciones               = $request -> especificaciones;
                $producto -> lugar_almacenamiento           = $request -> lugar_almacenamiento;
                $producto -> nombre_imagen                  = $request -> nombre_imagen;
            
                $producto-> save();
                return redirect( route('productos.inventario'));
            }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('plastiweg.productos.detalleproductos', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('plastiweg.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto -> nombre_producto                = strtoupper($request -> nombre_producto);
        $producto -> codigo_producto                = strtoupper($request -> codigo_producto);
        $producto -> contenido_unidades_por_empaque = $request -> contenido_unidades_por_empaque;
        $producto -> precio_empaque                 = $request -> precio_empaque;
        $producto -> stock_empaques                 = $producto -> stock_empaques;
        $producto -> stock_critico_empaques         = $request -> stock_critico_empaques;
        $producto -> especificaciones               = $request -> especificaciones;
        $producto -> lugar_almacenamiento           = $request -> lugar_almacenamiento;
        $producto -> nombre_imagen                  = $request -> nombre_imagen;
        
        $producto-> save();
        return redirect( route('productos.inventario'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect( route('productos.inventario') );
    }

    public function restore($producto_id)
    {
        $productos = Producto::withTrashed()->find($producto_id);
        $productos->restore();
        return redirect( route('productos.inventario') );
    }

    // inventario de productos - incluye eliminados
    public function inventario()
    {
        $productos = Producto::withTrashed()->paginate(9);
        return view('plastiweg.productos.inventario', compact('productos'));
    }

    // productos mas vendidos
    public function cotizado()
    {
        $productos = DB::select("SELECT p.*, IFNULL((SELECT SUM(d.cantidad)	FROM detalle_venta d WHERE d.producto_id_producto = p.id_producto GROUP BY d.producto_id_producto	ORDER BY d.producto_id_producto DESC LIMIT 5), 0) AS vendido FROM producto p ORDER BY vendido DESC LIMIT 5;");
        return view('plastiweg.informes.articulosMasCotizados', compact('productos'));
    }

    /**
     * Busqueda normal 
     * 
     */
    public function buscar(Request $request)
    {
        $nombre = $request->nombre_producto;
        $productos = Producto::where('nombre_producto', 'like', "%{$nombre}%")->paginate(9);
        return view('plastiweg.productos.index', compact('productos'));
    }

    /**
     * Búsqueda en Inventario 
     * 
     */
    public function buscarInv(Request $request)
    {
        $nombre = $request->nombre_producto;
        if ($nombre) {
            $productos = Producto::withTrashed()->where('nombre_producto', 'like', "%{$nombre}%")->paginate(9);
            return view('plastiweg.productos.inventario', compact('productos'));
        }else{
            $productos = Producto::withTrashed()->paginate(9);
            return view('plastiweg.productos.inventario', compact('productos'));
        }
        
    }

    /**
     * Paginas con productos 
     * de forma pública
     */

    // catalogo para invitados la pagina
    public function indexGuest()
    {
        $productos = Producto::paginate(9);
        return view('plastiweg.guest.catalogo', compact('productos'));
    }
    // busqueda catalago invitados
    public function buscarGuest(Request $request)
    {
        $nombre = $request->nombre_producto;
        $productos = Producto::where('nombre_producto', 'like', "%{$nombre}%")->simplePaginate(9);
        return view('plastiweg.guest.catalogo', compact('productos'));
    }

}
