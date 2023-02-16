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
        return view('home', compact('clientes', 'desayunos','almuerzos','cenas','lunch'));
    }
}
