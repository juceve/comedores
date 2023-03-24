<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:empresas.index')->only('index');
        $this->middleware('can:empresas.edit')->only('edit','update');
        $this->middleware('can:empresas.create')->only('create','store');
        $this->middleware('can:empresas.destroy')->only('destroy');
    }

    public function index()
    {
        $empresas = Empresa::all();

        return view('empresa.index', compact('empresas'));
    }

    public function create()
    {
        $empresa = new Empresa();
        return view('empresa.create', compact('empresa'));
    }

    public function store(Request $request)
    {
        request()->validate(Empresa::$rules);

        $empresa = Empresa::create($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa created successfully.');
    }


    public function edit($id)
    {
        $empresa = Empresa::find($id);
        return view('empresa.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        request()->validate(Empresa::$rules);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa updated successfully');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $empresa = Empresa::find($id)->delete();
            DB::commit();
            return redirect()->route('empresas.index')
                ->with('success', 'Empresa eliminada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('empresas.index')
                ->with('error', 'No se pudo completar la operación');
        }
    }
}
