<?php

namespace App\Http\Controllers;

use App\Models\Franja;
use Illuminate\Http\Request;

/**
 * Class FranjaController
 * @package App\Http\Controllers
 */
class FranjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $franjas = Franja::paginate(5);

        return view('franja.index', compact('franjas'))
            ->with('i', (request()->input('page', 1) - 1) * $franjas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $franja = new Franja();
        return view('franja.create', compact('franja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Franja::$rules);

        $franja = Franja::create($request->all());

        return redirect()->route('franjas.index')
            ->with('success', 'Franja created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $franja = Franja::find($id);

        return view('franja.show', compact('franja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $franja = Franja::find($id);

        return view('franja.edit', compact('franja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Franja $franja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Franja $franja)
    {
        request()->validate(Franja::$rules);

        $franja->update($request->all());

        return redirect()->route('franjas.index')
            ->with('success', 'Franja updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $franja = Franja::find($id)->delete();

        return redirect()->route('franjas.index')
            ->with('success', 'Franja deleted successfully');
    }
}
