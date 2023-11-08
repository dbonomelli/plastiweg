<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendedorCrearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plastiweg.vendedores.index', ['status' => ' ']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plastiweg.vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = DB::select("SELECT * FROM vendedor where usuario = :usu", ['usu' => $request->usuario]);
        if ($usuario) {
            return redirect( route('vendedor.create'));
        }else{
            $vendedor = new Vendedor();
            $vendedor->nombre_vendedor   = $request->nombre;
            $vendedor->apellido_vendedor = $request->apellido;
            $vendedor->usuario           = $request->usuario;
            $vendedor->password          = Hash::make($request->password);
            $vendedor->save();
            return redirect((route('vendedor.lista')));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedor)
    {
        return view('plastiweg.vendedores.show', compact('vendedor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {
        return view('plastiweg.vendedores.edit', compact('vendedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        $vendedor->nombre_vendedor   = $request->nombre;
        $vendedor->apellido_vendedor = $request->apellido;
        $vendedor->usuario           = $request->usuario;
        $vendedor->password          = Hash::make($request->password);
        $vendedor->save();
        return redirect((route('vendedor.lista')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedor)
    {
        $vendedor->delete();
        return redirect( route('vendedor.lista') );
    }


    /**
     *  Login de Vendedores.
     *  NO SE ESTÁ USANDO
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        session_start();
        //session is started if you don't write this line can't use $_Session  global variable/
        
        $usuario = $request ->vendedor_usuario;
        $contrasena = $request ->vendedor_contrasena;
        //OPCION 1
        $results = DB::select('select * from vendedor where usuario = :user and contrasena = :contrasena', ['user' => $usuario , 'contrasena' => $contrasena]);
        if ($results){
            //cred correctas
            return redirect()->route('inicio');
            
        }else{
            //cred incorrectas
            return view('plastiweg.vendedores.index', ['status' => '(credenciales incorrectas*)']);
        }
    }

    /**
     *  Logout de Vendedores.
     *  NO SE ESTÁ USANDO
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        session_start();
        //session is started if you don't write this line can't use $_Session  global variable/
        $_SESSION["vendedor_usuario"]=$request->vendedor_usuario;
        $_SESSION["password"]=$request->vendedor_contrasena;
        unset($_SESSION["newsession"]);
        //session deleted. if you try using this you've got an error/
        return redirect()->route('inicio');
    }

    // listado de vendedores activos
    public function lista(){
        $vendedores = Vendedor::paginate(10);
        return view('plastiweg.vendedores.lista', compact('vendedores'));
    }

}
