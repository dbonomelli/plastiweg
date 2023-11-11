<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ImagenProducto;

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
        $image = $request->file('nombre_imagen');
        $path = $image->getRealPath();
        $file = file_get_contents($path);
        $base64 = base64_encode($file);
        $image_name = $image->getClientOriginalName();
        $producto = new Producto();

            $prod = $request -> nombre_producto;
            $prod_rep = DB::select("SELECT * FROM producto where nombre_producto = :prod", ['prod' => $prod]);
            $prod_rep2 = DB::select("SELECT * FROM producto where codigo_producto = :cod", ['cod' => $request -> codigo_producto]);
            if ($prod_rep or $prod_rep2) {
                return redirect( route('productos.inventario'));
            }else{
                $imagen_producto = new ImagenProducto();

                $codigo = $request->codigo_producto;
                $codigo = str_replace(' ', '-', $codigo);
                $nom = $request -> nombre_producto;
                $producto -> nombre_producto                = strtoupper($nom);
                $producto -> codigo_producto                = strtoupper($codigo);
                $producto -> contenido_unidades_por_empaque = $request -> contenido_unidades_por_empaque;
                $producto -> precio_empaque                 = $request -> precio_empaque;
                $producto -> stock_empaques                 = $request -> stock_empaques;
                $producto -> stock_critico_empaques         = $request -> stock_critico_empaques;
                $producto -> especificaciones               = $request -> especificaciones;
                $producto -> lugar_almacenamiento           = $request -> lugar_almacenamiento;

                $producto-> save();

                $producto_id = $producto -> id_producto;

                $imagen_producto -> nombre_imagen = $image_name;
                $imagen_producto -> imagen = $base64;
                $imagen_producto -> producto_id_producto = $producto_id;
                $imagen_producto->save();
            

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
        $imagen = DB::select('SELECT nombre_imagen, imagen FROM imagen_producto WHERE producto_id_producto ='.$producto->id_producto);
        if(!empty($imagen)){
            $producto->nombre_imagen = $imagen[0]->nombre_imagen;
            $producto->imagen = 'data:image/png;base64,'.$imagen[0]->imagen;
            $producto->defaultImage = CotizacionController::getImage();
        }
        #dd($producto);
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
        if(!empty($request->nombre_imagen)){
            $image = $request->file('nombre_imagen');
            $path = $image->getRealPath();
            $file = file_get_contents($path);
            $base64 = base64_encode($file);
            $image_name = $image->getClientOriginalName();
            DB::table('imagen_producto')->where('producto_id_producto', $producto->id_producto)->update(['nombre_imagen' => $image_name, 'imagen' => $base64]);
        }
        $producto -> nombre_producto                = strtoupper($request -> nombre_producto);
        $producto -> codigo_producto                = strtoupper($request -> codigo_producto);
        $producto -> contenido_unidades_por_empaque = $request -> contenido_unidades_por_empaque;
        $producto -> precio_empaque                 = $request -> precio_empaque;
        $producto -> stock_empaques                 = $producto -> stock_empaques;
        $producto -> stock_critico_empaques         = $request -> stock_critico_empaques;
        $producto -> especificaciones               = $request -> especificaciones;
        $producto -> lugar_almacenamiento           = $request -> lugar_almacenamiento;
        
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
        $productos = ProductoController::searchImage($productos);
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
            $productos = ProductoController::searchImage($productos);
            return view('plastiweg.productos.inventario', compact('productos'));
        }else{
            $productos = Producto::withTrashed()->paginate(9);
            $productos = ProductoController::searchImage($productos);
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
        $productos = ProductoController::searchImage($productos);
        return view('plastiweg.guest.catalogo', compact('productos'));
    }
    // busqueda catalago invitados
    public function buscarGuest(Request $request)
    {
        $nombre = $request->nombre_producto;
        $productos = Producto::where('nombre_producto', 'like', "%{$nombre}%")->simplePaginate(9);
        $productos = ProductoController::searchImage($productos);
        return view('plastiweg.guest.catalogo', compact('productos'));
    }

    public function searchImage($productos){
        foreach($productos as $producto){
            $imagen = DB::select('SELECT imagen FROM imagen_producto WHERE producto_id_producto ='.$producto->id_producto);
            if(empty($imagen)){
                $producto->imagen = CotizacionController::getImage();
            }else{
                $producto->imagen = 'data:image/png;base64,'.$imagen[0]->imagen;
            }
        }
        return $productos;
    }

}
