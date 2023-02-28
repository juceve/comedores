<?php

namespace App\Http\Livewire\Entregas;

use App\Models\Franja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Diario extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fecha;
    public $selectedFranjas = array();
    public $contenedor = null;

    public function mount()
    {
        $this->fecha = date('Y-m-d');
    }

    public function updatedSelectedFranjas()
    {
        $this->emit('updateSelect2');
    }

    public function updatedFecha()
    {
        $this->emit('updateSelect2');
    }

    public function render()
    {
        $this->reset(['contenedor']);
        $franjas = Franja::all();
        $count = count($this->selectedFranjas);
        if (count($this->selectedFranjas) == 0) {
            foreach ($franjas as $franja) {
                $resultado = $this->buscador($this->fecha, $franja->id);
                $this->contenedor[] = $resultado;
            }
        } else {
            foreach ($this->selectedFranjas as $franja) {

                $resultado = $this->buscador($this->fecha, $franja);
                $this->contenedor[] = $resultado;
            }
        }



        return view('livewire.entregas.diario', compact('franjas'))->extends('adminlte::page');
    }

    public function buscador($fecha, $franja_id)
    {
        $franja = Franja::find($franja_id);
        $entregas = DB::table('entregas')
            ->rightJoin('franjas', 'franjas.id', '=', 'entregas.franja_id')
            ->where('entregas.fecha', $fecha)
            ->where('entregas.franja_id', $franja_id)
            ->select(DB::raw('count(entregas.id) as cant, sum(franjas.precio) as total'))
            ->first();
        $resultado = array("nombre" => $franja->nombre, "precio" => number_format($franja->precio, 2, '.', ','), "cantidad" => $entregas->cant, "total" => is_null($entregas->total) ? '0.00' : $entregas->total);
        return $resultado;
    }

    public function pdf()
    {
        $this->emit('updateSelect2');
        $pdf = Pdf::loadView('entrega.reportes.diario', ['contenedor' => $this->contenedor, 'fecha' => $this->fecha])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "Reporte_Entregas_" . $this->fecha . date('_His') . ".pdf"
        );
    }
}
