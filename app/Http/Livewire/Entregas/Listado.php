<?php

namespace App\Http\Livewire\Entregas;

use App\Exports\ListadoEntregaExport;
use App\Models\Empresa;
use App\Models\Entrega;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Listado extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $empresas, $fechai, $fechaf, $criterio = "", $selectedEmpresas = array(), $selEmpresas = array();

    public function mount()
    {
        $this->fechai = date('Y-m-d');
        $this->fechaf = date('Y-m-d');
        $this->empresas = Empresa::where('reportes', 1)->get();
    }

    public function render()
    {
        $this->emit('updateSelect2');
        if (count($this->selectedEmpresas) == 0) {

            foreach ($this->empresas as $empresa) {
                $this->selEmpresas[] = $empresa->id;
            }
        } else {
            $this->selEmpresas = $this->selectedEmpresas;
        }

        $entregas = DB::table('entregas')
            ->join('clientes', 'clientes.id', '=', 'entregas.cliente_id')
            ->join('empresas', 'empresas.id', '=', 'clientes.empresa_id')
            ->join('franjas', 'franjas.id', '=', 'entregas.franja_id')
            ->where(function ($query) {
                $query->whereBetween('entregas.fecha', [$this->fechai, $this->fechaf])
                    ->where('clientes.nombre', 'LIKE', "%$this->criterio%")
                    ->whereIn('clientes.empresa_id', $this->selEmpresas);
            })
            ->orWhere(function ($query) {
                $query->whereBetween('entregas.fecha', [$this->fechai, $this->fechaf])
                    ->where('franjas.nombre', 'LIKE', "%$this->criterio%")
                    ->whereIn('clientes.empresa_id', $this->selEmpresas);
            })

            ->select('entregas.id', 'entregas.created_at', 'clientes.nombre as cliente', 'franjas.nombre as franja')
            ->paginate(5);
        $this->resetPage();
        return view('livewire.entregas.listado', compact('entregas'));
    }

    public function pdf()
    {
        $this->emit('updateSelect2');

        if (count($this->selectedEmpresas) == 0) {

            foreach ($this->empresas as $empresa) {
                $this->selEmpresas[] = $empresa->id;
            }
        } else {
            $this->selEmpresas = $this->selectedEmpresas;
        }

        $entregas = DB::table('entregas')
            ->join('clientes', 'clientes.id', '=', 'entregas.cliente_id')
            ->join('empresas', 'empresas.id', '=', 'clientes.empresa_id')
            ->join('franjas', 'franjas.id', '=', 'entregas.franja_id')
            ->where(function ($query) {
                $query->whereBetween('entregas.fecha', [$this->fechai, $this->fechaf])
                    ->where('clientes.nombre', 'LIKE', "%$this->criterio%")
                    ->whereIn('clientes.empresa_id', $this->selEmpresas);
            })
            ->orWhere(function ($query) {
                $query->whereBetween('entregas.fecha', [$this->fechai, $this->fechaf])
                    ->where('franjas.nombre', 'LIKE', "%$this->criterio%")
                    ->whereIn('clientes.empresa_id', $this->selEmpresas);
            })

            ->select('entregas.id', 'entregas.created_at', 'clientes.nombre as cliente', 'franjas.nombre as franja')
            ->get();

        $pdf = Pdf::loadView('entrega.reportes.listado', ['entregas' => $entregas, 'fechai' => $this->fechai, 'fechaf' => $this->fechaf])->output();
        // return $pdf->stream();
        return response()->streamDownload(
            fn () => print($pdf),
            "Entregas_" . date('dmY_His') . ".pdf"
        );
    }

    public function excel()
    {
        $this->emit('updateSelect2');

        if (count($this->selectedEmpresas) == 0) {

            foreach ($this->empresas as $empresa) {
                $this->selEmpresas[] = $empresa->id;
            }
        } else {
            $this->selEmpresas = $this->selectedEmpresas;
        }

        $entregas = DB::table('entregas')
            ->join('clientes', 'clientes.id', '=', 'entregas.cliente_id')
            ->join('empresas', 'empresas.id', '=', 'clientes.empresa_id')
            ->join('franjas', 'franjas.id', '=', 'entregas.franja_id')
            ->where(function ($query) {
                $query->whereBetween('entregas.fecha', [$this->fechai, $this->fechaf])
                    ->where('clientes.nombre', 'LIKE', "%$this->criterio%")
                    ->whereIn('clientes.empresa_id', $this->selEmpresas);
            })
            ->orWhere(function ($query) {
                $query->whereBetween('entregas.fecha', [$this->fechai, $this->fechaf])
                    ->where('franjas.nombre', 'LIKE', "%$this->criterio%")
                    ->whereIn('clientes.empresa_id', $this->selEmpresas);
            })

            ->select('entregas.id', 'entregas.created_at', 'clientes.nombre as cliente', 'franjas.nombre as franja')
            ->get();

        return Excel::download(new ListadoEntregaExport($entregas, $this->fechai, $this->fechaf), 'Rep_ListadoEntregas_' . date('His') . '.xlsx');
    }
}
