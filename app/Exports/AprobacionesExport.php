<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AprobacionesExport implements FromView, ShouldAutoSize
{
    public $contenedor, $fecha;

    public function __construct($contenedor,$fecha)
    {
        $this->contenedor = $contenedor;
        $this->fecha = $fecha;
    }

    public function view(): View
    {
        return view('reserva.reportes.excel.diario', [
            "contenedor" => $this->contenedor,
            "fecha" => $this->fecha,
        ]);
    }
}
