<?php

namespace App\Http\Controllers;

use App\Models\Invdetalle;
use Illuminate\Http\Request;

/**
 * Class InvdetalleController
 * @package App\Http\Controllers
 */
class InvdetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invdetalles = Invdetalle::paginate();

        return view('invdetalle.index', compact('invdetalles'))
            ->with('i', (request()->input('page', 1) - 1) * $invdetalles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invdetalle = new Invdetalle();
        return view('invdetalle.create', compact('invdetalle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Invdetalle::$rules);

        $invdetalle = Invdetalle::create($request->all());

        return redirect()->route('invdetalles.index')
            ->with('success', 'Invdetalle created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invdetalle = Invdetalle::find($id);

        return view('invdetalle.show', compact('invdetalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invdetalle = Invdetalle::find($id);

        return view('invdetalle.edit', compact('invdetalle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Invdetalle $invdetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invdetalle $invdetalle)
    {
        request()->validate(Invdetalle::$rules);

        $invdetalle->update($request->all());

        return redirect()->route('invdetalles.index')
            ->with('success', 'Invdetalle updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $invdetalle = Invdetalle::find($id)->delete();

        return redirect()->route('invdetalles.index')
            ->with('success', 'Invdetalle deleted successfully');
    }
}
