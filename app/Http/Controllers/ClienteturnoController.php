<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Clienteturno;
use Illuminate\Http\Request;

/**
 * Class ClienteturnoController
 * @package App\Http\Controllers
 */
class ClienteturnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienteturnos = Clienteturno::paginate();
        $clientes = Cliente::all();
        return view('clienteturno.index', compact('clienteturnos','clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clienteturnos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clienteturno = new Clienteturno();
        return view('clienteturno.create', compact('clienteturno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Clienteturno::$rules);

        $clienteturno = Clienteturno::create($request->all());

        return redirect()->route('clienteturnos.index')
            ->with('success', 'Clienteturno created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clienteturno = Clienteturno::find($id);

        return view('clienteturno.show', compact('clienteturno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clienteturno = Clienteturno::find($id);

        return view('clienteturno.edit', compact('clienteturno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Clienteturno $clienteturno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clienteturno $clienteturno)
    {
        request()->validate(Clienteturno::$rules);

        $clienteturno->update($request->all());

        return redirect()->route('clienteturnos.index')
            ->with('success', 'Clienteturno updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clienteturno = Clienteturno::find($id)->delete();

        return redirect()->route('clienteturnos.index')
            ->with('success', 'Clienteturno deleted successfully');
    }
}
