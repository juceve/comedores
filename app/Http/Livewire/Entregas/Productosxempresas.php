<?php

namespace App\Http\Livewire\Entregas;

use App\Exports\prodxempExport;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Productosxempresas extends Component
{
    public $fechai, $fechaf, $empresas;
    public $selectedEmpresas = array(), $contenedor = null;
    public $incluirTodas = false;

    public function mount()
    {
        $this->fechai = date('Y-m-d');
        $this->fechaf = date('Y-m-d');
        $this->reset(['empresas']);

        $this->empresas = Empresa::where('reportes', 1)->get();
    }

    public function updatedSelectedEmpresas()
    {
        $this->emit('updateSelect2');
    }

    public function updatedFechai()
    {
        $this->emit('updateSelect2');
    }
    public function updatedIncluirTodas()
    {
        $this->emit('updateSelect2');
        if ($this->incluirTodas) {
            $this->empresas = Empresa::all();
        } else {
            $this->empresas = Empresa::where('reportes', 1)->get();
        }
    }

    public function updatedFechaf()
    {
        $this->emit('updateSelect2');
    }

    public function render()
    {
        $selected = array();
        if (count($this->selectedEmpresas) == 0) {

            foreach ($this->empresas as $empresa) {
                $selected[] = $empresa->id;
            }
        } else {
            $selected = $this->selectedEmpresas;
        }

        $empresas = implode(",", $selected);

        $sql = "select em.nombre empresa , f.nombre franja, count(*) cantidad, sum(f.precio) subtotal  from entregas e
        INNER JOIN clientes c ON e.cliente_id = c.id
        INNER JOIN empresas em on em.id = c.empresa_id
        INNER JOIN franjas f ON f.id = e.franja_id
        WHERE fecha BETWEEN '$this->fechai' AND '$this->fechaf'
        AND e.estado = 1
        AND em.id in ($empresas)
        GROUP BY f.nombre, em.nombre
        ORDER BY em.nombre, f.id";

        $entregas = DB::select($sql);
        $contenedor = [];
        $this->reset(['contenedor']);
        if (count($entregas)) {
            $empresa = "";
            $data = null;
            $totalCantidad = 0;
            $totalImporte = 0;
            $b = 0;

            foreach ($entregas as $item) {
                if ($empresa != $item->empresa) {
                    if ($b > 0) {
                        $contenedor[] = array($empresa, $totalCantidad, $data, $totalImporte);
                    }
                    $b++;
                    $empresa = $item->empresa;
                    $data = null;
                    $data[] = array($item->franja, $item->cantidad, $item->subtotal);
                    $totalCantidad = 0;
                    $totalImporte = 0;
                } else {
                    $data[] = array($item->franja, $item->cantidad, $item->subtotal);
                }
                $totalCantidad = $totalCantidad + $item->cantidad;
                $totalImporte = $totalImporte + $item->subtotal;
            }
            $contenedor[] = array($empresa, $totalCantidad, $data, $totalImporte);
            $this->contenedor = $contenedor;
        }

        return view('livewire.entregas.productosxempresas')->extends('adminlte::page');
    }

    public function pdf()
    {
        $this->emit('updateSelect2');
        $pdf = Pdf::loadView('entrega.reportes.prodxemp', ['contenedor' => $this->contenedor, 'fechai' => $this->fechai, 'fechaf' => $this->fechaf])->output();
        return response()->streamDownload(
            fn () => print($pdf),
            "Reporte_ProdXEmp_" . date('Y-m-d') . date('_His') . ".pdf"
        );
    }

    public function excel(){
        $this->emit('updateSelect2');
        return Excel::download(new prodxempExport($this->contenedor,$this->fechai, $this->fechaf), 'Rep_prodxemp_'.date('His').'.xlsx');
    }
}
