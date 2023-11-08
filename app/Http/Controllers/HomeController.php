<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Cotizacion;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only(['indexGuest']);
    }

    public function index(){
        $stocks =  DB::table('producto')
                    ->where('producto.stock_critico_empaques', '>', 'productos.stock_empaques')
                    ->paginate(5);

        $startDate = now()->format('Y-m-d');
        $endDate = now()->addDays(60)->format('Y-m-d');
        $cotizaciones = DB::table('cotizacion')
                    ->whereBetween('fecha_emision', [$startDate, $endDate])
                    ->where('estado', '=', 'p')
                    ->paginate(5);
        #DB::select('CALL spCotizacionesAntiguasDelete');
        return view('plastiweg.index', compact('cotizaciones', 'stocks'));
    }

    public function indexGuest(){
        return view('plastiweg.guest.index');
    }
}
