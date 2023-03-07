<?php

namespace App\Http\Livewire\Aprobaciones;

use App\Models\Franja;
use App\Models\Reservalunch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RepDiario extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fecha;
    
    public $contenedor = null;

    public function mount()
    {
        $this->fecha = date('Y-m-d');
    }     

    public function render()
    {
        $this->reset(['contenedor']);
        // $franjas = Franja::all();
        
        $aprobaciones = Reservalunch::where('fecha',$this->fecha)
                                    ->where('estado',1)
                                    ->get();
        $this->reset(['contenedor']);
        foreach ($aprobaciones as $item) {
            $array = array(
                "cliente" => $item->cliente->nombre,
                "estado" => $item->estado?'APROBADO':'PENDIENTE',
                "user" => $item->user->name,
            );
            $this->contenedor[] = $array;
        }
        return view('livewire.aprobaciones.rep-diario', compact('aprobaciones'))->extends('adminlte::page');
    }  

    public function pdf()
    {       
        
        $pdf = Pdf::loadView('reservalunch.reportes.diario', ['contenedor' => $this->contenedor, 'fecha' => $this->fecha])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "Reporte_AprobacionLunches_" . $this->fecha . date('_His') . ".pdf"
        );
    }
}
