<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;

/**
 * Class EntregaController
 * @package App\Http\Controllers
 */
class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entregas = Entrega::paginate();

        return view('entrega.index', compact('entregas'))
            ->with('i', (request()->input('page', 1) - 1) * $entregas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entrega = new Entrega();
        return view('entrega.create', compact('entrega'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Entrega::$rules);

        $entrega = Entrega::create($request->all());

        return redirect()->route('entregas.index')
            ->with('success', 'Entrega created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrega = Entrega::find($id);

        return view('entrega.show', compact('entrega'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entrega = Entrega::find($id);

        return view('entrega.edit', compact('entrega'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Entrega $entrega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrega $entrega)
    {
        request()->validate(Entrega::$rules);

        $entrega->update($request->all());

        return redirect()->route('entregas.index')
            ->with('success', 'Entrega updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $entrega = Entrega::find($id)->delete();

        return redirect()->route('entregas.index')
            ->with('success', 'Entrega deleted successfully');
    }
}
