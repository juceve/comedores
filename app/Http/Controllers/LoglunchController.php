<?php

namespace App\Http\Controllers;

use App\Models\Loglunch;
use Illuminate\Http\Request;

/**
 * Class LoglunchController
 * @package App\Http\Controllers
 */
class LoglunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loglunches = Loglunch::paginate();

        return view('loglunch.index', compact('loglunches'))
            ->with('i', (request()->input('page', 1) - 1) * $loglunches->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loglunch = new Loglunch();
        return view('loglunch.create', compact('loglunch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Loglunch::$rules);

        $loglunch = Loglunch::create($request->all());

        return redirect()->route('loglunches.index')
            ->with('success', 'Loglunch created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loglunch = Loglunch::find($id);

        return view('loglunch.show', compact('loglunch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loglunch = Loglunch::find($id);

        return view('loglunch.edit', compact('loglunch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Loglunch $loglunch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loglunch $loglunch)
    {
        request()->validate(Loglunch::$rules);

        $loglunch->update($request->all());

        return redirect()->route('loglunches.index')
            ->with('success', 'Loglunch updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $loglunch = Loglunch::find($id)->delete();

        return redirect()->route('loglunches.index')
            ->with('success', 'Loglunch deleted successfully');
    }
}
