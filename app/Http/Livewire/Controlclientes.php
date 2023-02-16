<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Entrega;
use App\Models\Franja;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Livewire;

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
                    DB::commit();
                    $this->reset(['cedula', 'cliente']);
                    $this->emit('success', 'Entregado correctamente');
                } catch (\Throwable $th) {
                    DB::rollback();
                    $this->emit('error', 'Ha ocurrido un error, no se registró el pedido');
                }
            }
        }
    }
}
