<?php

namespace App\Http\Controllers;

use App\Models\Kiosko;
use Illuminate\Http\Request;

/**
 * Class KioskoController
 * @package App\Http\Controllers
 */
class KioskoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kioskos = Kiosko::paginate();

        return view('kiosko.index', compact('kioskos'))
            ->with('i', (request()->input('page', 1) - 1) * $kioskos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kiosko = new Kiosko();
        return view('kiosko.create', compact('kiosko'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Kiosko::$rules);

        $kiosko = Kiosko::create($request->all());

        return redirect()->route('kioskos.index')
            ->with('success', 'Kiosko created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kiosko = Kiosko::find($id);

        return view('kiosko.show', compact('kiosko'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kiosko = Kiosko::find($id);

        return view('kiosko.edit', compact('kiosko'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Kiosko $kiosko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kiosko $kiosko)
    {
        request()->validate(Kiosko::$rules);

        $kiosko->update($request->all());

        return redirect()->route('kioskos.index')
            ->with('success', 'Kiosko updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kiosko = Kiosko::find($id)->delete();

        return redirect()->route('kioskos.index')
            ->with('success', 'Kiosko deleted successfully');
    }
}
