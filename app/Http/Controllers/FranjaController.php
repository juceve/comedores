<?php

namespace App\Http\Controllers;

use App\Models\Franja;
use Illuminate\Http\Request;

class FranjaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:franjas.index')->only('index');
        $this->middleware('can:franjas.edit')->only('edit','update');
        $this->middleware('can:franjas.create')->only('create','store');
        $this->middleware('can:franjas.destroy')->only('destroy');
    }

    public function index()
    {
        $franjas = Franja::paginate(5);

        return view('franja.index', compact('franjas'))
            ->with('i', (request()->input('page', 1) - 1) * $franjas->perPage());
    }

    public function create()
    {
        $franja = new Franja();
        return view('franja.create', compact('franja'));
    }

    public function store(Request $request)
    {
        request()->validate(Franja::$rules);

        $franja = Franja::create($request->all());

        return redirect()->route('franjas.index')
            ->with('success', 'Franja created successfully.');
    }

    public function show($id)
    {
        $franja = Franja::find($id);

        return view('franja.show', compact('franja'));
    }

    public function edit($id)
    {
        $franja = Franja::find($id);

        return view('franja.edit', compact('franja'));
    }

    public function update(Request $request, Franja $franja)
    {
        request()->validate(Franja::$rules);

        $franja->update($request->all());

        return redirect()->route('franjas.index')
            ->with('success', 'Franja updated successfully');
    }

    public function destroy($id)
    {
        $franja = Franja::find($id)->delete();

        return redirect()->route('franjas.index')
            ->with('success', 'Franja deleted successfully');
    }
}
