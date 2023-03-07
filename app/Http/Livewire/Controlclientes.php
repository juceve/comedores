<?php

namespace App\Http\Livewire;

use App\Http\Controllers\printPOSController;
use App\Models\Cliente;
use App\Models\Entrega;
use App\Models\Franja;
use App\Models\Reservalunch;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\Livewire;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Controlclientes extends Component
{
    public $cedula = "", $cliente = null, $franja = null;

    public function render()
    {
        $franja = Franja::all();
        $alimento = "";
        foreach ($franja as $item) {
            $inicio = strtotime($item->horainicio);
            $final = strtotime($item->horafinal);
            $ahora = strtotime(date('H:i:s'));
            if (($ahora >= $inicio) && ($ahora <= $final)) {
                $alimento = $item->nombre;
            }
        }
        if ($alimento != "") {
            $alimento = "HORARIO DE " . $alimento;
        }
        return view('livewire.controlclientes', compact('alimento'));
    }

    protected $listeners = ['registrarEntrega'];

    public function busqueda()
    {
        $franjas = Franja::all();
        foreach ($franjas as $franja) {
            $inicio = strtotime($franja->horainicio);
            $final = strtotime($franja->horafinal);
            $ahora = strtotime(date('H:i:s'));
            if (($ahora >= $inicio) && ($ahora <= $final)) {
                $this->franja = $franja;
            }
        }

        if (!is_null($this->franja)) {
            $this->cliente = Cliente::where('cedula', $this->cedula)->first();

            if (!is_null($this->cliente)) {

                $entrega = Entrega::where('fecha', date('Y-m-d'))
                    ->where('cliente_id', $this->cliente->id)
                    ->where('franja_id', $this->franja->id)
                    ->get();
                if ($entrega->count() > 0) {
                    $this->emit('error', 'YA SE RECOGIÓ ' . $this->franja->nombre . ' PARA EL CLIENTE SELECCIONADO.');
                } else {
                    $cadenaResultado = $this->cliente->id . "|" . $this->cliente->nombre . "|" . $this->franja->nombre . "|" . $this->cliente->empresa . "|" . $this->cliente->cedula;
                    $this->emit('inicioRegistro', $cadenaResultado);
                }
            } else {
                $this->reset(['cedula', 'cliente']);
                $this->emit('error', 'Cliente no encontrado');
            }
        } else {
            $this->reset(['cedula', 'cliente']);
            $this->emit('error', 'Fuera de horario.');
        }
    }

    public function registrarEntrega()
    {
        if (!is_null($this->cliente)) {
            $entrega = Entrega::where('fecha', date('Y-m-d'))
                ->where('cliente_id', $this->cliente->id)
                ->where('franja_id', $this->franja->id)
                ->get();
            if ($entrega->count() > 0) {
                $this->emit('error', 'YA SE RECOGIÓ ' . $this->franja->nombre . ' PARA EL CLIENTE SELECCIONADO.');
            } else {
                DB::beginTransaction();
                try {
                    $entrega = Entrega::create([
                        'fecha' => date('Y-m-d'),
                        'cliente_id' => $this->cliente->id,
                        'franja_id' => $this->franja->id,
                    ]);

                    if($this->cliente->lunch){
                        $reservaLunch = Reservalunch::create([
                            'fecha' => date('Y-m-d'),
                            'cliente_id' => $this->cliente->id
                        ]);
                    }
                    DB::commit();
                    // $this->print($entrega); //LINEA DE IMPRESION SERVIDOR LOCAL

                    $datos = $entrega->id."|".$entrega->franja->nombre."|".$entrega->cliente->nombre."|".$entrega->created_at;
                    redirect('http://localhost/gprinter/public/print/'.$datos); //IMPRESION MEDIANTE LOCALHOST DEL CLIENTE
                    $this->reset(['cedula', 'cliente']);
                    $this->emit('success', 'Entregado correctamente');
                } catch (\Throwable $th) {
                    DB::rollback();
                    $this->emit('error', $th->getMessage());//'Ha ocurrido un error, no se registró el pedido'
                }
            }
        }
    }
    public function print(Entrega $entrega)
    {
        ///// impresion ticket ////////
        $nombreImpresora = "gprinter1";
        $connector = new WindowsPrintConnector($nombreImpresora);
        $impresora = new Printer($connector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(2, 2);
        $impresora->text("ENTREGA DE " . $entrega->franja->nombre . "\n");
        $impresora->setTextSize(2, 1);
        $impresora->text("---------------------- \n");      
        $impresora->text("Nro.: " . str_pad($entrega->id, 6, "0", STR_PAD_LEFT) . "\n");
        $impresora->setTextSize(1, 1);   
        $impresora->text("Cliente: " . $entrega->cliente->nombre . "\n");             
        $impresora->text($entrega->created_at . "\n");
        $impresora->feed(2);
        $impresora->cut();
        $impresora->close();
        ///////////////////////////////
    }
}
