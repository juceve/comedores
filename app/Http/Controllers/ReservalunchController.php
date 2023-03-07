<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Reservalunch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservalunchController extends Controller
{

    public function index()
    {
        $reservalunches = Reservalunch::where('estado', 0)
            ->where('fecha', date('Y-m-d'))
            ->get();

        return view('reservalunch.index', compact('reservalunches'));
    }


    public function show($id)
    {
        $reservalunch = Reservalunch::find($id);

        return view('reservalunch.show', compact('reservalunch'));
    }

    public function approved($id)
    {
        $reservalunch = Reservalunch::find($id);
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

                return redirect()->route('reservalunches.index')
                    ->with('success', 'Reserva aprobada con exito.');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('reservalunches.index')
                    ->with('error', 'Algo salió mal, no se registro la transacción.');
            }
        }
    }

    public function approvedAll()
    {
        $reservalunches = Reservalunch::where('fecha', date('Y-m-d'))
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
                return redirect()->route('reservalunches.index')
                    ->with('error', 'Algo salió mal, no se registró la transacción.');
            }
        }
    }

    public function destroy($id)
    {
        $reservalunch = Reservalunch::find($id)->delete();

        return redirect()->route('reservalunches.index')
            ->with('success', 'Reserva elminada correctamente.');
    }
}
