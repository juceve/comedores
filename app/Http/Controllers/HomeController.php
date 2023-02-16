<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Entrega;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientes = Cliente::all();
        $entregas = Entrega::where('fecha',date('Y-m-d'))->get();
        return view('home',compact('clientes','entregas'));
    }
}
