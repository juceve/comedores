<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Clienteturno;
use App\Models\Configturno;
use App\Models\Entrega;
use App\Models\Franja;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Controlclientes extends Component
{
    public $cedula = "", $cliente = null, $franja = null,$reservaFranja="",$generaReserva = false ;
    private $clienteturno = null ;

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
            $sql = "select c.id,c.nombre,c.cedula, ct.turno_id from clienteturnos ct
            INNER JOIN clientes c on c.id = ct.cliente_id
            INNER JOIN turnos  t on t.id = ct.turno_id
            WHERE c.cedula = '$this->cedula'";
            $clienteturnos = DB::select($sql);
            if (count($clienteturnos) > 0) {

                $configs = null;
                foreach ($clienteturnos as $clienteturno) {
                    $this->cliente = Cliente::find($clienteturno->id);
                    $this->clienteturno = $clienteturno;
                    $sql2 = "SELECT t.nombre turno, cf.franja_id,cf.presencial,cf.generareserva,cf.reservafranja from turnos t
                    INNER JOIN configturnos cf on cf.turno_id = t.id
                    WHERE  t.id = " . $clienteturno->turno_id . "
                    AND cf.franja_id = " . $this->franja->id;
                    $configs = DB::select($sql2);
                }
                if (count($configs) > 0) {
                    $presencial = null;
                    foreach ($configs as $config) {
                        $presencial = $config->presencial;
                        $this->generaReserva = $config->generareserva;
                        $this->reservaFranja = $config->reservafranja;
                    }
                    if ($presencial) {
                        $entrega = Entrega::where('fecha', date('Y-m-d'))
                            ->where('cliente_id', $this->cliente->id)
                            ->where('franja_id', $this->franja->id)
                            ->get();
                        if ($entrega->count() > 0) {
                            $this->emit('error', 'YA SE RECOGIÓ ' . $this->franja->nombre . ' PARA EL CLIENTE SELECCIONADO.');
                        } else {
                            $cadenaResultado = $this->cliente->id . "|" . $this->cliente->nombre . "|" . $this->franja->nombre . "|" . $this->cliente->empresa . "|" . $this->cliente->cedula;
                            $this->emit('inicioRegistro', $cadenaResultado); //FIN DEL PROCESO DE BUSQUEDA Y PREPARACION PARA LOS CLIENTES CON TURNOS
                        }
                    } else {
                        $this->emit('error', $this->franja->nombre . ' no habilitado de forma presencial');
                    }
                } else {
                    $this->emit('error', $this->franja->nombre . ' no habilitado para este Cliente.');
                }
            } else {
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
                        $this->emit('inicioRegistro', $cadenaResultado); // FIN DEL PROCESO DE BUSQUEDA Y PREPARACION PARA LOS CLIENTES COMUNES
                    }
                } else {
                    $this->reset(['cedula', 'cliente']);
                    $this->emit('error', 'Cliente no encontrado');
                }
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
                    $reserva = null;
                    
                    if ($this->reservaFranja != ""){
                        if ($this->generaReserva) {
                            $reserva = Reserva::create([
                                'fecha' => date('Y-m-d'),
                                'cliente_id' => $this->cliente->id,
                                'franja_id' => $this->reservaFranja,
                            ]);
                        }
                    }
                    
                    DB::commit();
                    //$this->print($entrega); //LINEA DE IMPRESION SERVIDOR LOCAL

                    $datos = $entrega->id . "|" . $entrega->franja->nombre . "|" . $entrega->cliente->nombre . "|" . $entrega->created_at;
                    redirect('http://127.0.0.1/gprinter/public/print/' . $datos); //IMPRESION MEDIANTE LOCALHOST DEL CLIENTE
                    $this->reset(['cedula', 'cliente']);
                    $this->emit('success', 'Entregado correctamente');
                } catch (\Throwable $th) {
                    DB::rollback();
                    $this->emit('error', $th->getMessage()); //'Ha ocurrido un error, no se registró el pedido'
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
