<?php

namespace App\Http\Controllers;

use App\Models\Entregasmanuale;
use Illuminate\Http\Request;

/**
 * Class EntregasmanualeController
 * @package App\Http\Controllers
 */
class EntregasmanualeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entregasmanuales = Entregasmanuale::paginate();

        return view('entregasmanuale.index', compact('entregasmanuales'))
            ->with('i', (request()->input('page', 1) - 1) * $entregasmanuales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entregasmanuale = new Entregasmanuale();
        return view('entregasmanuale.create', compact('entregasmanuale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Entregasmanuale::$rules);

        $entregasmanuale = Entregasmanuale::create($request->all());

        return redirect()->route('entregasmanuales.index')
            ->with('success', 'Entregasmanuale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entregasmanuale = Entregasmanuale::find($id);

        return view('entregasmanuale.show', compact('entregasmanuale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entregasmanuale = Entregasmanuale::find($id);

        return view('entregasmanuale.edit', compact('entregasmanuale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Entregasmanuale $entregasmanuale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entregasmanuale $entregasmanuale)
    {
        request()->validate(Entregasmanuale::$rules);

        $entregasmanuale->update($request->all());

        return redirect()->route('entregasmanuales.index')
            ->with('success', 'Entregasmanuale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $entregasmanuale = Entregasmanuale::find($id)->delete();

        return redirect()->route('entregasmanuales.index')
            ->with('success', 'Entregasmanuale deleted successfully');
    }
}
