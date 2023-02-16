<?php

namespace App\Http\Livewire\Entregas;

use App\Models\Entrega;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class Listado extends Component
{
    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';

    public $fechai, $fechaf, $criterio = "";

    public function mount(){
        $this->fechai = date('Y-m-d');
        $this->fechaf = date('Y-m-d');
    }

    public function updatingCriterio(){
        $this->resetPage();
    }

    public function updatingFechai(){
        $this->resetPage();
    }

    public function updatingFechaf(){
        $this->resetPage();
    }

    public function render()
    {        
        $entregas = DB::table('entregas')
                            ->join('clientes','clientes.id','=','entregas.cliente_id')
                            ->join('franjas','franjas.id','=','entregas.franja_id')  
                            ->where(function($query) {
                                $query->whereBetween('entregas.fecha',[$this->fechai,$this->fechaf])
                                      ->where('clientes.nombre','LIKE',"%$this->criterio%");
                            })   
                            ->orWhere(function($query) {
                                $query->whereBetween('entregas.fecha',[$this->fechai,$this->fechaf])
                                      ->where('franjas.nombre','LIKE',"%$this->criterio%");
                            })                       
                            
                            ->select('entregas.id','entregas.created_at','clientes.nombre as cliente','franjas.nombre as franja')
                            ->paginate(5);
        return view('livewire.entregas.listado',compact('entregas'));
    }

    public function pdf(){        
        $entregas = DB::table('entregas')
        ->join('clientes','clientes.id','=','entregas.cliente_id')
        ->join('franjas','franjas.id','=','entregas.franja_id')  
        ->where(function($query) {
            $query->whereBetween('entregas.fecha',[$this->fechai,$this->fechaf])
                  ->where('clientes.nombre','LIKE',"%$this->criterio%");
        })   
        ->orWhere(function($query) {
            $query->whereBetween('entregas.fecha',[$this->fechai,$this->fechaf])
                  ->where('franjas.nombre','LIKE',"%$this->criterio%");
        }) 
        ->select('entregas.id','entregas.created_at','clientes.nombre as cliente','franjas.nombre as franja')->get();

        

    $pdf = Pdf::loadView('entrega.reportes.listado', ['entregas' => $entregas,'fechai' => $this->fechai,'fechaf' => $this->fechaf])->output();
    // return $pdf->stream();
    return response()->streamDownload(
        fn () => print($pdf),
        "Entregas_".date('dmY_His').".pdf"
   );
    }
}
