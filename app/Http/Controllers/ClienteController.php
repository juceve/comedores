<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Loglunch;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{   

    public function index()
    {
        $clientes = Cliente::all();

        return view('cliente.index', compact('clientes'));
    }

    public function clientesPDF()
    {
        $clientes = Cliente::all();

        $pdf = Pdf::loadView('cliente.reportes.clientes', ['clientes' => $clientes]);
        return $pdf->stream();
    }

    public function create()
    {
        $cliente = new Cliente();
        $empresas = Empresa::all()->pluck('nombre','id');
        return view('cliente.create', compact('cliente','empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cliente::$rules);

        $cliente = Cliente::create($request->all());
        $cliente->lunch = 0;
        $cliente->save();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        $logs = Loglunch::where('cliente_id',$id)->get();
        return view('cliente.show', compact('cliente','logs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $empresas = Empresa::all()->pluck('nombre','id');
        return view('cliente.edit', compact('cliente','empresas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        request()->validate(Cliente::$rules);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente->estado) {
            $cliente->estado = 0;
        } else {
            $cliente->estado = 1;
        }
        $cliente->save();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado');
    }

    public function lunch($id){
        $cliente = Cliente::find($id);
        if ($cliente->lunch) {
            $cliente->lunch = 0;
            $loglunch = Loglunch::create([
                "tipo" => "BAJA",
                "cliente_id" => $id,
                "user_id" => Auth::user()->id,
            ]);
        } else {
            $cliente->lunch = 1;
            $loglunch = Loglunch::create([
                "tipo" => "ALTA",
                "cliente_id" => $id,
                "user_id" => Auth::user()->id,
            ]);
        }
        $cliente->save();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado');
    }
}
