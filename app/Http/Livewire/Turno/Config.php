<?php

namespace App\Http\Livewire\Turno;

use App\Models\Configturno;
use App\Models\Franja;
use App\Models\Turno;
use Livewire\Component;

class Config extends Component
{
    public $turno;
    public function mount($id)
    {
        $this->turno = Turno::find($id);
    }

    protected $listeners = ['save', 'delete'];

    public function render()
    {
        $franjas = Franja::all();
        $detalles = Configturno::where('turno_id', $this->turno->id)->get();
        return view('livewire.turno.config', compact('franjas', 'detalles'))->extends('adminlte::page');
    }

    public function save($franja_id, $presencial, $genreserva, $franjareserva)
    {
        if ($genreserva) {
            if ($franjareserva != "") {
                $configTurno = Configturno::create([
                    "turno_id" => $this->turno->id,
                    "franja_id" => $franja_id,
                    "presencial" => $presencial,
                    "generareserva" => $genreserva,
                    "reservafranja" => $franjareserva,
                ]);
                $reserva = Configturno::create([
                    "turno_id" => $this->turno->id,
                    "franja_id" => $franjareserva,
                    "presencial" => false,
                    "generareserva" => false,
                ]);
                $this->emit('success', "Item agregado correctamente");
            } else {
                $this->emit('error', "Debe seleccionar una franja para la reserva.");
            }
        } else {
            $configTurno = Configturno::create([
                "turno_id" => $this->turno->id,
                "franja_id" => $franja_id,
                "presencial" => $presencial,
                "generareserva" => $genreserva,
            ]);
            $this->emit('success', "Item agregado correctamente");
        }
    }

    public function delete($id)
    {
        $detale = Configturno::find($id)->delete();
        $this->emit('success', "Item elminado correctamente");
    }
}
