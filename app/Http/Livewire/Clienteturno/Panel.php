<?php

namespace App\Http\Livewire\Clienteturno;

use App\Models\Cliente;
use App\Models\Clienteturno;
use App\Models\Empresa;
use App\Models\Turno;
use Livewire\Component;

class Panel extends Component
{
    public $cliente = null, $empresa = null, $nombre = "", $nombreempresa = "", $selTurno = "";
    public $busqueda = "", $cnombrecliente ='', $cselTurno ='', $clienteturno = null;
    protected $listeners = ['seleccionar','remover','selCambioTurno','cambiarTurno'];

    public function render()
    {
        $clienteturnos = Clienteturno::all();
        $clientes = Cliente::all();
        $turnos = Turno::all();
        return view('livewire.clienteturno.panel', compact('clienteturnos', 'clientes', 'turnos'))->extends('adminlte::page');
    }

    public function buscarCliente()
    {
        $this->cliente = Cliente::where('cedula', $this->busqueda)->first();
        $clienteTurno = Clienteturno::where('cliente_id',$this->cliente->id)->first();
        if (!is_null($this->cliente)) {
            if (is_null($clienteTurno)) {
                $this->nombre = $this->cliente->nombre;
                $this->nombreempresa = $this->cliente->empresa->nombre;
            } else {
                $this->emit('error', 'El cliente ya se encuentra agregado.');
                $this->busqueda = "";
            }
        } else {
            $this->emit('error', 'Cliente no encontrado.');
            $this->busqueda = "";
        }
    }

    public function seleccionar($cliente_id)
    {
        $this->cliente = Cliente::find($cliente_id);
        $clienteTurno = Clienteturno::where('cliente_id',$this->cliente->id)->first();
        if (!is_null($this->cliente)) {
            if (is_null($clienteTurno)) {
                $this->nombre = $this->cliente->nombre;
                $this->nombreempresa = $this->cliente->empresa->nombre;
                $this->emit('cerrarModal');
            } else {
                $this->emit('error', 'El cliente ya se encuentra agregado.');
                $this->emit('cerrarModal');
            }
            
        } else {
            $this->emit('error', 'Cliente no encontrado.');
        }
    }

    public function save()
    {
        if (!is_null($this->cliente)) {
            if ($this->selTurno != "") {
                $cliente = Clienteturno::create([
                    "cliente_id" => $this->cliente->id,
                    "turno_id" => $this->selTurno,
                ]);
                return redirect()->route('clienteturnos')
                    ->with('success', 'Cliente agregado correctamente.');
            } else {
                $this->emit('error', 'Debe seleccionar un turno.');
            }
        } else {
            $this->emit('error', 'Debe seleccionar un cliente.');
        }
    }

    public function remover($id){
        $clienteturno = Clienteturno::find($id)->delete();
        return redirect()->route('clienteturnos')
                    ->with('success', 'Cliente removido correctamente.');
    }

    public function selCambioTurno($id){
        $this->reset(['clienteturno']);
        $this->clienteturno = Clienteturno::find($id);
        $this->cnombrecliente = $this->clienteturno->cliente->nombre;
        $this->cselTurno = $this->clienteturno->turno_id;
    }

    public function cambiarTurno(){
        $this->clienteturno->turno_id = $this->cselTurno;
        $this->clienteturno->save();
        return redirect()->route('clienteturnos')
                    ->with('success', 'Cliente actualizado correctamente.');
    }
}
