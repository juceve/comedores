<?php

namespace App\Http\Livewire\Entregas;

use App\Exports\EntregaExport;
use App\Models\Franja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Diario extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fechai,$fechaf;
    public $selectedFranjas = array();
    public $contenedor = null;

    public function mount()
    {
        $this->fechai = date('Y-m-d');
        $this->fechaf = date('Y-m-d');
    }

    public function updatedSelectedFranjas()
    {
        $this->emit('updateSelect2');
    }

    public function updatedFechai()
    {
        $this->emit('updateSelect2');
    }
    public function updatedFechaf()
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
                $resultado = $this->buscador($this->fechai, $this->fechaf, $franja->id);
                $this->contenedor[] = $resultado;
            }
        } else {
            foreach ($this->selectedFranjas as $franja) {

                $resultado = $this->buscador($this->fechai, $this->fechaf, $franja);
                $this->contenedor[] = $resultado;
            }
        }
        return view('livewire.entregas.diario', compact('franjas'))->extends('adminlte::page');
    }

    public function buscador($fechai, $fechaf, $franja_id)
    {
        $franja = Franja::find($franja_id);
        $entregas = DB::table('entregas')
            ->rightJoin('franjas', 'franjas.id', '=', 'entregas.franja_id')            
            ->whereBetween('entregas.fecha', [$fechai, $fechaf])
            ->where('entregas.estado', 1)
            ->where('entregas.franja_id', $franja_id)
            ->select(DB::raw('count(entregas.id) as cant, sum(franjas.precio) as total'))
            ->first();
        $resultado = array("nombre" => $franja->nombre, "precio" => number_format($franja->precio, 2, '.', ','), "cantidad" => $entregas->cant, "total" => is_null($entregas->total) ? '0.00' : $entregas->total);
        return $resultado;
    }

    public function pdf()
    {
        $this->emit('updateSelect2');
        $pdf = Pdf::loadView('entrega.reportes.diario', ['contenedor' => $this->contenedor, 'fechai' => $this->fechai, 'fechaf' => $this->fechaf])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "Reporte_Entregas_" . date('His') . ".pdf"
        );
    }

    public function excel(){
        $this->emit('updateSelect2');
        return Excel::download(new EntregaExport($this->contenedor,$this->fechai,$this->fechaf), 'Rep_Entregas_'.date('His').'.xlsx');
    }
}
