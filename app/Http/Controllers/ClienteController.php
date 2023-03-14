<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ClienteController extends Controller
{   

    public function index()
    {
        $clientes = Cliente::all();
        // dd($clientes);
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

    public function store(Request $request)
    {
        request()->validate(Cliente::$rules);

        $cliente = Cliente::create($request->all());        

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);        
        return view('cliente.show', compact('cliente'));
    }


    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $empresas = Empresa::all()->pluck('nombre','id');
        return view('cliente.edit', compact('cliente','empresas'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        request()->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'estado' => 'required',
            'empresa_id' => 'required',
          ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

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

}
