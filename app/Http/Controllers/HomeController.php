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

        ///////////////////////////////////////////////////////////////////////////////////////
        $hoy =date('Y-m-d');
        $sql = "SELECT f.nombre nombre, COUNT(*) cantidad, SUM(f.precio) total FROM entregas e
       INNER JOIN franjas f on e.franja_id = f.id
       WHERE fecha = '$hoy' 
       AND e.franja_id = 1
       AND e.estado = 1
       GROUP BY f.nombre";
        $desayunos =  DB::select($sql);

        $sql = "SELECT f.nombre nombre, COUNT(*) cantidad, SUM(f.precio) total FROM entregas e
       INNER JOIN franjas f on e.franja_id = f.id
       WHERE fecha = '$hoy' 
       AND e.franja_id = 2
       AND e.estado = 1
       GROUP BY f.nombre";
        $almuerzos =  DB::select($sql);

        $sql = "SELECT f.nombre nombre, COUNT(*) cantidad, SUM(f.precio) total FROM entregas e
       INNER JOIN franjas f on e.franja_id = f.id
       WHERE fecha = '$hoy' 
       AND e.franja_id = 3
       AND e.estado = 1
       GROUP BY f.nombre";
        $cenas =  DB::select($sql);

        $sql = "SELECT f.nombre nombre, COUNT(*) cantidad, SUM(f.precio) total FROM entregas e
       INNER JOIN franjas f on e.franja_id = f.id
       WHERE fecha = '$hoy' 
       AND e.franja_id = 4
       AND e.estado = 1
       GROUP BY f.nombre";
        $lunchs =  DB::select($sql);

        ///////////////////////////////////////////////////////////////////////////////////////
        $mensuales = DB::table('entregas')
            ->join('clientes', 'clientes.id', '=', 'entregas.cliente_id')
            ->join('empresas', 'empresas.id', '=', 'clientes.empresa_id')
            ->whereMonth('entregas.fecha', date('m'))
            ->where('entregas.estado', 1)
            ->select(DB::raw('count(entregas.id) cantidad, empresas.nombre empresa'))
            ->groupBy('empresas.nombre')
            ->get();
        $empresa = "";
        $cantidad = "";
        foreach ($mensuales as $item) {
            if ($empresa == "") {
                $empresa = $item->empresa;
                $cantidad = $item->cantidad;
            } else {
                $empresa = $empresa . "|" . $item->empresa;
                $cantidad = $cantidad . "|" . $item->cantidad;
            }
        }

        return view('home', compact('clientes', 'desayunos', 'almuerzos', 'cenas', 'lunchs', 'empresa', 'cantidad'));
    }
}
