<?php

namespace App\Http\Livewire\Entregas;

use App\Models\Cliente;
use App\Models\Clienteturno;
use App\Models\Entrega;
use App\Models\Entregasmanuale;
use App\Models\Franja;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Manuales extends Component
{
    public $cliente = null,  $nombre = "", $fechaEntrega = "", $selFranja = "";
    public $busqueda = "", $cnombrecliente = '', $cselTurno = '';
    protected $listeners = ['seleccionar', 'remover'];


    public function render()
    {
        $sql = "SELECT em.id, em.created_at, e.id identrega,
        e.fecha fechaentrega, c.nombre cliente,
        emp.nombre empresa, f.nombre franja 
        FROM entregasmanuales em
        INNER JOIN entregas e ON e.id = em.entrega_id
        INNER JOIN clientes c ON c.id = e.cliente_id
        INNER JOIN empresas emp ON emp.id = c.empresa_id
        INNER JOIN franjas f ON f.id = e.franja_id
        WHERE em.estado = 1";

        $entregasmanuales = DB::select($sql);


        $clientes = Cliente::all();
        $franjas = Franja::all();

        // $this->emit('datatables', '');
        return view('livewire.entregas.manuales', compact('clientes', 'franjas', 'entregasmanuales'))->extends('adminlte::page');
    }

    public function buscarCliente()
    {
        $this->cliente = Cliente::where('cedula', $this->busqueda)->first();

        if (!is_null($this->cliente)) {
            $this->nombre = $this->cliente->nombre;
        } else {
            $this->emit('error', 'Cliente no encontrado.');
            $this->busqueda = "";
        }
    }

    public function seleccionar($cliente_id)
    {
        $this->cliente = Cliente::find($cliente_id);
        if (!is_null($this->cliente)) {
            $this->nombre = $this->cliente->nombre;
            $this->emit('cerrarModal');
        } else {
            $this->emit('error', 'Cliente no encontrado.');
        }
    }

    public function save()
    {
        if (!is_null($this->cliente)) {
            if ($this->fechaEntrega != "") {
                if ($this->selFranja != "") {
                    DB::beginTransaction();
                    try {
                        $entrega = Entrega::create([
                            'fecha' => $this->fechaEntrega,
                            'cliente_id' => $this->cliente->id,
                            'franja_id' => $this->selFranja,
                            'created_at' => $this->fechaEntrega . date(' H:i:s'),
                        ]);

                        $entregaManual = Entregasmanuale::create([
                            "entrega_id" => $entrega->id,
                            "user_id" => Auth::user()->id,
                            "ip" => request()->ip()
                        ]);
                        DB::commit();
                        return redirect()->route('entregasmanuales')
                            ->with('success', 'Cliente agregado correctamente.');
                    } catch (\Throwable $th) {
                        DB::rollback();
                        $this->emit('error', $th->getMessage());
                    }
                } else {
                    $this->emit('error', 'Debe seleccionar un producto.');
                }
            } else {
                $this->emit('error', 'Debe seleccionar una fecha de entrega.');
            }
        } else {
            $this->emit('error', 'Debe seleccionar un cliente.');
        }
    }

    public function remover($id)
    {
        DB::beginTransaction();
        try {
            $entregamanual = Entregasmanuale::find($id);
            $entregamanual->estado = false;
            $entregamanual->save();

            $entrega = Entrega::find($entregamanual->entrega_id);   
            $entrega->estado = false;
            $entrega->save();        

            DB::commit();
            return redirect()->route('entregasmanuales')
                ->with('success', 'Entrega anulada correctamente.');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('error', $th->getMessage());
            // $this->emit('error', 'Ocurrio un error, no se modificaron los registros.');
        }
    }
}
