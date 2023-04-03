<?php

namespace App\Http\Controllers;

use App\Models\Reganulacione;
use Illuminate\Http\Request;

/**
 * Class ReganulacioneController
 * @package App\Http\Controllers
 */
class ReganulacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reganulaciones = Reganulacione::paginate();

        return view('reganulacione.index', compact('reganulaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $reganulaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reganulacione = new Reganulacione();
        return view('reganulacione.create', compact('reganulacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Reganulacione::$rules);

        $reganulacione = Reganulacione::create($request->all());

        return redirect()->route('reganulaciones.index')
            ->with('success', 'Reganulacione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reganulacione = Reganulacione::find($id);

        return view('reganulacione.show', compact('reganulacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reganulacione = Reganulacione::find($id);

        return view('reganulacione.edit', compact('reganulacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Reganulacione $reganulacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reganulacione $reganulacione)
    {
        request()->validate(Reganulacione::$rules);

        $reganulacione->update($request->all());

        return redirect()->route('reganulaciones.index')
            ->with('success', 'Reganulacione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reganulacione = Reganulacione::find($id)->delete();

        return redirect()->route('reganulaciones.index')
            ->with('success', 'Reganulacione deleted successfully');
    }
}
