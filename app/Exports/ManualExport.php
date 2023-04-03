<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ManualExport implements FromView, ShouldAutoSize
{
    public $contenedor, $fechai,$fechaf;

    public function __construct($contenedor,$fechai,$fechaf)
    {
        $this->contenedor = $contenedor;
        $this->fechai = $fechai;
        $this->fechaf = $fechaf;
    }

    public function view(): View
    {
        return view('entrega.reportes.excel.manual', [
            "entregasmanuales" => $this->contenedor,
            "fechai" => $this->fechai,
            "fechaf" => $this->fechaf,
        ]);
    }
}
