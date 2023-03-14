<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{

    public function index()
    {
        $reservas = Reserva::where('fecha',date('Y-m-d'))
                            ->where('estado',false)
                            ->get();

        return view('reserva.index', compact('reservas'));
    }


    public function create()
    {
        $reserva = new Reserva();
        return view('reserva.create', compact('reserva'));
    }


    public function store(Request $request)
    {
        request()->validate(Reserva::$rules);

        $reserva = Reserva::create($request->all());

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva created successfully.');
    }


    public function show($id)
    {
        $reserva = Reserva::find($id);

        return view('reserva.show', compact('reserva'));
    }



    public function approved($id)
    {
        $reservalunch = Reserva::find($id);
        if (!$reservalunch->estado) {
            DB::beginTransaction();
            try {

                $reservalunch->estado = 1;
                $reservalunch->user_id = Auth::user()->id;
                $reservalunch->save();

                $entrega =  Entrega::create([
                    'fecha' => date('Y-m-d'),
                    'cliente_id' => $reservalunch->cliente_id,
                    'franja_id' => 4,
                ]);

                DB::commit();

                return redirect()->route('reservas.index')
                    ->with('success', 'Reserva aprobada con exito.');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('reservas.index')
                    ->with('error', 'Algo salió mal, no se registro la transacción.');
            }
        }
    }

    public function approvedAll()
    {
        $reservalunches = Reserva::where('fecha', date('Y-m-d'))
        ->where('estado', 0)
        ->get();
        if ($reservalunches->count() > 0) {
            DB::beginTransaction();
            try {
                foreach ($reservalunches as $reservalunch) {
                    $reservalunch->estado = 1;
                    $reservalunch->user_id = Auth::user()->id;
                    $reservalunch->save();

                    $entrega =  Entrega::create([
                        'fecha' => date('Y-m-d'),
                        'cliente_id' => $reservalunch->cliente_id,
                        'franja_id' => 4,
                    ]);
                }

                DB::commit();

                return redirect()->route('repdiario')
                    ->with('success', 'Reservas aprobadas con exito.');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('reservas.index')
                    ->with('error', 'Algo salió mal, no se registró la transacción.');
            }
        }
    }

    public function destroy($id)
    {
        $reservalunch = Reserva::find($id)->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva elminada correctamente.');
    }
}
