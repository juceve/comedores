<?php

namespace App\Http\Controllers;

use App\Models\Configturno;
use Illuminate\Http\Request;

/**
 * Class ConfigturnoController
 * @package App\Http\Controllers
 */
class ConfigturnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configturnos = Configturno::paginate();

        return view('configturno.index', compact('configturnos'))
            ->with('i', (request()->input('page', 1) - 1) * $configturnos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $configturno = new Configturno();
        return view('configturno.create', compact('configturno'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Configturno::$rules);

        $configturno = Configturno::create($request->all());

        return redirect()->route('configturnos.index')
            ->with('success', 'Configturno created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $configturno = Configturno::find($id);

        return view('configturno.show', compact('configturno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configturno = Configturno::find($id);

        return view('configturno.edit', compact('configturno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Configturno $configturno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configturno $configturno)
    {
        request()->validate(Configturno::$rules);

        $configturno->update($request->all());

        return redirect()->route('configturnos.index')
            ->with('success', 'Configturno updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $configturno = Configturno::find($id)->delete();

        return redirect()->route('configturnos.index')
            ->with('success', 'Configturno deleted successfully');
    }
}
