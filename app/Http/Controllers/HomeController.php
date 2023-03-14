<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Entrega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $desayunos = Entrega::where('fecha', date('Y-m-d'))
            ->where('franja_id', 1)
            ->get();
        $almuerzos = Entrega::where('fecha', date('Y-m-d'))
            ->where('franja_id', 2)
            ->get();
        $cenas = Entrega::where('fecha', date('Y-m-d'))
            ->where('franja_id', 3)
            ->get();
        $lunch = Entrega::where('fecha', date('Y-m-d'))
            ->where('franja_id', 4)
            ->orWhere('franja_id', 5)
            ->get();
        //////////////////////////////////////////////////////////
        $mensuales = DB::table('entregas')
        ->join('clientes','clientes.id','=','entregas.cliente_id')  
        ->join('empresas','empresas.id','=','clientes.empresa_id')      
        ->whereMonth('entregas.fecha', date('m'))        
        ->select(DB::raw('count(entregas.id) cantidad, empresas.nombre empresa'))
        ->groupBy('empresas.nombre')
        ->get();
        $empresa="";
        $cantidad="";
        foreach ($mensuales as $item) {
            if($empresa==""){
                $empresa = $item->empresa;
                $cantidad = $item->cantidad;
            }else{
                $empresa = $empresa."|".$item->empresa;
                $cantidad = $cantidad."|".$item->cantidad;
            }            
        }
        
        return view('home', compact('clientes', 'desayunos','almuerzos','cenas','lunch','empresa','cantidad'));
    }
}
