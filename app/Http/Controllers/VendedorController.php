<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendedorController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except(['logout']);
    }

    public function index(){
        //info
    }

    public function login(Request $request){
        $credenciales = $request->only('usuario','password');
        if(Auth::attempt($credenciales)){
            return redirect()->route('inicio');
        }
        else{
            return redirect()->route('vendedor.index')->withErrors('Credenciales inválidas.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function home()
    {
        return view('plastiweg.vendedores.index');
    }
}
