<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{

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
            ->with('success', 'Turno created successfully.');
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
            ->with('success', 'Turno updated successfully');
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
                ->with('error', 'Ocurrio un error.');
        }
    }
}
