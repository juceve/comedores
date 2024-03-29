<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Clienteturno;
use Illuminate\Http\Request;

class ClienteturnoController extends Controller
{
    

    public function index()
    {
        $clienteturnos = Clienteturno::paginate();
        $clientes = Cliente::all();
        return view('clienteturno.index', compact('clienteturnos','clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clienteturnos->perPage());
    }


    public function create()
    {
        $clienteturno = new Clienteturno();
        return view('clienteturno.create', compact('clienteturno'));
    }

    public function store(Request $request)
    {
        request()->validate(Clienteturno::$rules);

        $clienteturno = Clienteturno::create($request->all());

        return redirect()->route('clienteturnos.index')
            ->with('success', 'Clienteturno created successfully.');
    }

    public function show($id)
    {
        $clienteturno = Clienteturno::find($id);

        return view('clienteturno.show', compact('clienteturno'));
    }

    public function edit($id)
    {
        $clienteturno = Clienteturno::find($id);

        return view('clienteturno.edit', compact('clienteturno'));
    }


    public function update(Request $request, Clienteturno $clienteturno)
    {
        request()->validate(Clienteturno::$rules);

        $clienteturno->update($request->all());

        return redirect()->route('clienteturnos.index')
            ->with('success', 'Clienteturno updated successfully');
    }


    public function destroy($id)
    {
        $clienteturno = Clienteturno::find($id)->delete();

        return redirect()->route('clienteturnos.index')
            ->with('success', 'Clienteturno deleted successfully');
    }
}
