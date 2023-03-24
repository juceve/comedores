<?php

namespace App\Http\Controllers;

use App\Models\Mensualidade;
use Illuminate\Http\Request;

/**
 * Class MensualidadeController
 * @package App\Http\Controllers
 */
class MensualidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensualidades = Mensualidade::paginate();

        return view('mensualidade.index', compact('mensualidades'))
            ->with('i', (request()->input('page', 1) - 1) * $mensualidades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mensualidade = new Mensualidade();
        return view('mensualidade.create', compact('mensualidade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Mensualidade::$rules);

        $mensualidade = Mensualidade::create($request->all());

        return redirect()->route('mensualidades.index')
            ->with('success', 'Mensualidade created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mensualidade = Mensualidade::find($id);

        return view('mensualidade.show', compact('mensualidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mensualidade = Mensualidade::find($id);

        return view('mensualidade.edit', compact('mensualidade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Mensualidade $mensualidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensualidade $mensualidade)
    {
        request()->validate(Mensualidade::$rules);

        $mensualidade->update($request->all());

        return redirect()->route('mensualidades.index')
            ->with('success', 'Mensualidade updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mensualidade = Mensualidade::find($id)->delete();

        return redirect()->route('mensualidades.index')
            ->with('success', 'Mensualidade deleted successfully');
    }
}
