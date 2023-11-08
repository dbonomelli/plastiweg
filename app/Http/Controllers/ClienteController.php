<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $clientes = Cliente::paginate(10);
        return view('plastiweg.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = DB::select("SELECT * FROM region");
        $comunas = DB::select("SELECT * FROM comuna");
        return view('plastiweg.clientes.create', compact('regiones', 'comunas'));
    }
    public function createCliente()
    {
        $regiones = DB::select("SELECT * FROM region");
        $comunas = DB::select("SELECT * FROM comuna");
        return view('plastiweg.clientes.createCliente', compact('regiones', 'comunas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente_rep = DB::select("SELECT * FROM cliente where rut = :rutCli LIMIT 1", ['rutCli' => $request->rut]);
        if ($cliente_rep != null) {
            try {
               restore($request->rut);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }else {
            $cliente = new Cliente();
            $cliente->rut                       = $request->rut;
            $cliente->nombre_cliente            = $request->nombre;
            $cliente->apellido_cliente          = $request->apellido;
            $cliente->fecha_ingreso_cliente     = date('Y-m-d H:i:s');
            $cliente->telefono_contacto_cliente = $request->telefono;
            $cliente->correo                    = $request->email;
            $cliente->direccion_cliente         = $request->direccion;
            $cliente->direccion_despacho        = $request->direccion_despacho;
            $cliente->direccion_entrega_od      = $request->direccion_despacho;
            $cliente->nombre_pers_contacto      = $request->nombre_pers_contacto;
            $cliente->telefono_pers_contacto    = $request->telefono_pers_contacto;
            $cliente->Comuna_idComuna           = $request->comuna;
            $cliente->save();
        }
        return redirect( route("cotizaciones.create") );
    }
    public function storeCliente(Request $request)
    {
        $cliente_rep = DB::select("SELECT * FROM cliente where rut = :rutCli LIMIT 1", ['rutCli' => $request->rut]);
        if ($cliente_rep != null) {
            try {
               restore($request->rut);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }else {
            $cliente = new Cliente();
            $cliente->rut                       = $request->rut;
            $cliente->nombre_cliente            = $request->nombre;
            $cliente->apellido_cliente          = $request->apellido;
            $cliente->fecha_ingreso_cliente     = date('Y-m-d H:i:s');
            $cliente->telefono_contacto_cliente = $request->telefono;
            $cliente->correo                    = $request->email;
            $cliente->direccion_cliente         = $request->direccion;
            $cliente->direccion_despacho        = $request->direccion_despacho;
            $cliente->direccion_entrega_od      = $request->direccion_despacho;
            $cliente->nombre_pers_contacto      = $request->nombre_pers_contacto;
            $cliente->telefono_pers_contacto    = $request->telefono_pers_contacto;
            $cliente->Comuna_idComuna           = $request->comuna;
            $cliente->save();
        }

        return redirect( route('cliente') );
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $clientes = DB::table('cliente')
                        ->join('comuna', 'cliente.Comuna_idComuna', '=', 'comuna.id_comuna')
                        ->join('region', 'comuna.region_id_region', '=', 'region.id_region')
                        ->select('cliente.id_cliente', 'cliente.rut', 'cliente.nombre_cliente', 'cliente.apellido_cliente', 'cliente.telefono_contacto_cliente',
                                 'cliente.correo', 'cliente.direccion_cliente', 'cliente.direccion_entrega_od', 'cliente.nombre_pers_contacto',
                                 'cliente.telefono_pers_contacto', 'cliente.direccion_despacho', 'comuna.nombre_comuna', 'region.id_region', 'region.nombre_region')
                        ->where('cliente.id_cliente', '=', $cliente->id_cliente)
                        ->get()->first();                
        return view('plastiweg.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $regiones = DB::select("SELECT * FROM region");
        $comunas = DB::select("SELECT * FROM comuna");
        $clientes = DB::table('cliente')
                        ->join('comuna', 'cliente.Comuna_idComuna', '=', 'comuna.id_comuna')
                        ->join('region', 'comuna.region_id_region', '=', 'region.id_region')
                        ->select('cliente.id_cliente', 'cliente.rut', 'cliente.nombre_cliente', 'cliente.apellido_cliente', 'cliente.telefono_contacto_cliente',
                                 'cliente.correo', 'cliente.direccion_cliente', 'cliente.direccion_entrega_od', 'cliente.nombre_pers_contacto', 'cliente.Comuna_idComuna', 'cliente.telefono_pers_contacto', 'cliente.direccion_despacho','comuna.id_comuna', 'comuna.nombre_comuna', 'region.id_region', 'region.nombre_region')
                        ->where('cliente.id_cliente', '=', $cliente->id_cliente)
                        ->get()->first(); 
        return view('plastiweg.clientes.edit', compact('clientes', 'regiones', 'comunas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->rut                       = $request->rut;
        $cliente->nombre_cliente            = $request->nombre;
        $cliente->apellido_cliente          = $request->apellido;
        $cliente->telefono_contacto_cliente = $request->telefono;
        $cliente->correo                    = $request->email;
        $cliente->direccion_cliente         = $request->direccion;
        $cliente->direccion_despacho        = $request->direccion_despacho;
        $cliente->direccion_entrega_od      = $request->direccion_entrega_od;
        $cliente->nombre_pers_contacto      = $request->nombre_pers_contacto;
        $cliente->telefono_pers_contacto    = $request->telefono_pers_contacto;
        $cliente->Comuna_idComuna           = $request->comuna;
        $cliente->save();
        return redirect((route('cliente')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect( route('cliente') );
    }

    public function frecuentes()
    {
        $clientes = DB::select("SELECT DISTINCT C.nombre_cliente, C.apellido_cliente, C.rut, C.direccion_cliente, C.telefono_contacto_cliente, C.correo, COUNT(CO.cliente_id_cliente) AS CANTIDAD 
                                FROM cliente C INNER JOIN cotizacion CO ON CO.cliente_id_cliente = C.id_cliente INNER JOIN venta V ON V.cotizacion_num_cotizacion = CO.num_cotizacion 
                                GROUP BY C.id_cliente, C.nombre_cliente, C.apellido_cliente, C.rut, C.direccion_cliente, C.telefono_contacto_cliente, C.correo, CO.cliente_id_cliente, V.num_venta ORDER BY COUNT(CO.cliente_id_cliente) 
                                DESC LIMIT 4;");
        return view('plastiweg.informes.clientesFrecuentes', compact('clientes'));
    }
    
    public function restore($rut)
    {
        $cliente = Cliente::withTrashed()->find($rut);
        $cliente->restore();
    }
}
