<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;


class EntregaController extends Controller
{
    public function index()
    {
        return view('entrega.index');
    }
}
