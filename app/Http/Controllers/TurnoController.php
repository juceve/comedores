<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:turnos.index')->only('index');
        $this->middleware('can:turnos.edit')->only('edit','update');
        $this->middleware('can:turnos.create')->only('create','store');
        $this->middleware('can:turnos.destroy')->only('destroy');
    }

    public function index()
    {
        $turnos = Turno::paginate();

        return view('turno.index', compact('turnos'))
            ->with('i', (request()->input('page', 1) - 1) * $turnos->perPage());
    }

    public function create()
    {
        $turno = new Turno();
        return view('turno.create', compact('turno'));
    }

    public function store(Request $request)
    {
        request()->validate(Turno::$rules);

        $turno = Turno::create($request->all());

        return redirect()->route('turnos.index')
            ->with('success', 'Turno creado correctamente.');
    }

    public function show($id)
    {
        $turno = Turno::find($id);

        return view('turno.show', compact('turno'));
    }

    public function edit($id)
    {
        $turno = Turno::find($id);

        return view('turno.edit', compact('turno'));
    }

    public function update(Request $request, Turno $turno)
    {
        request()->validate(Turno::$rules);

        $turno->update($request->all());

        return redirect()->route('turnos.index')
            ->with('success', 'Turno actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $turno = Turno::find($id)->delete();
            DB::commit();
            return redirect()->route('turnos.index')
                ->with('success', 'Turno eliminado correctamente');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('turnos.index')
                ->with('error', 'No se puede eliminar un Turno si tiene clientes asociados.');
        }
    }
}
