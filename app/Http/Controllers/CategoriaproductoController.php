<?php

namespace App\Http\Controllers;

use App\Models\Categoriaproducto;
use Illuminate\Http\Request;

/**
 * Class CategoriaproductoController
 * @package App\Http\Controllers
 */
class CategoriaproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriaproductos = Categoriaproducto::all();

        return view('categoriaproducto.index', compact('categoriaproductos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriaproducto = new Categoriaproducto();
        return view('categoriaproducto.create', compact('categoriaproducto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Categoriaproducto::$rules);

        $categoriaproducto = Categoriaproducto::create($request->all());

        return redirect()->route('categoriaproductos.index')
            ->with('success', 'Categoriaproducto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoriaproducto = Categoriaproducto::find($id);

        return view('categoriaproducto.show', compact('categoriaproducto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoriaproducto = Categoriaproducto::find($id);

        return view('categoriaproducto.edit', compact('categoriaproducto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoriaproducto $categoriaproducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoriaproducto $categoriaproducto)
    {
        request()->validate(Categoriaproducto::$rules);

        $categoriaproducto->update($request->all());

        return redirect()->route('categoriaproductos.index')
            ->with('success', 'Categoriaproducto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoriaproducto = Categoriaproducto::find($id)->delete();

        return redirect()->route('categoriaproductos.index')
            ->with('success', 'Categoriaproducto deleted successfully');
    }
}
