<?php

namespace App\Http\Controllers;

use App\Models\Traspaso;
use Illuminate\Http\Request;

/**
 * Class TraspasoController
 * @package App\Http\Controllers
 */
class TraspasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traspasos = Traspaso::paginate();

        return view('traspaso.index', compact('traspasos'))
            ->with('i', (request()->input('page', 1) - 1) * $traspasos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $traspaso = new Traspaso();
        return view('traspaso.create', compact('traspaso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Traspaso::$rules);

        $traspaso = Traspaso::create($request->all());

        return redirect()->route('traspasos.index')
            ->with('success', 'Traspaso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $traspaso = Traspaso::find($id);

        return view('traspaso.show', compact('traspaso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $traspaso = Traspaso::find($id);

        return view('traspaso.edit', compact('traspaso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Traspaso $traspaso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traspaso $traspaso)
    {
        request()->validate(Traspaso::$rules);

        $traspaso->update($request->all());

        return redirect()->route('traspasos.index')
            ->with('success', 'Traspaso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $traspaso = Traspaso::find($id)->delete();

        return redirect()->route('traspasos.index')
            ->with('success', 'Traspaso deleted successfully');
    }
}
