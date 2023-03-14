<?php

namespace App\Http\Livewire\Aprobaciones;

use App\Exports\AprobacionesExport;
use App\Models\Franja;
use App\Models\Reserva;
use App\Models\Reservalunch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class RepDiario extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fecha, $selFranja = "";

    public $contenedor = null;

    public function mount()
    {
        $this->fecha = date('Y-m-d');
    }

    public function render()
    {
        $aprobaciones = null;
        $this->reset(['contenedor']);
        $franjas = Franja::all();
        if ($this->selFranja == "") {
            $aprobaciones = Reserva::where('fecha', $this->fecha)
                ->where('estado', 1)
                ->get();
        } else {
            $aprobaciones = Reserva::where('fecha', $this->fecha)
                ->where('estado', 1)
                ->where('franja_id',$this->selFranja)
                ->get();
        }

        $this->reset(['contenedor']);
        foreach ($aprobaciones as $item) {
            $array = array(
                "cliente" => $item->cliente->nombre,
                "franja" => $item->franja->nombre,
                "user" => $item->user->name,
            );
            $this->contenedor[] = $array;
        }
        return view('livewire.aprobaciones.rep-diario', compact('aprobaciones','franjas'))->extends('adminlte::page');
    }

    public function pdf()
    {
        $pdf = Pdf::loadView('reserva.reportes.diario', ['contenedor' => $this->contenedor, 'fecha' => $this->fecha])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "Rep_AprobacionReservas_" . $this->fecha . date('_His') . ".pdf"
        );
    }

    public function excel(){
        // $this->emit('updateSelect2');
        return Excel::download(new AprobacionesExport($this->contenedor, $this->fecha), "Rep_AprobacionReservas_" . $this->fecha .date('His').'.xlsx');
    }
}
