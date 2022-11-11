<?php

namespace App\Http\Controllers;

use App\Models\Preciostienda;
use Illuminate\Http\Request;

/**
 * Class PreciostiendaController
 * @package App\Http\Controllers
 */
class PreciostiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preciostiendas = Preciostienda::paginate();

        return view('preciostienda.index', compact('preciostiendas'))
            ->with('i', (request()->input('page', 1) - 1) * $preciostiendas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $preciostienda = new Preciostienda();
        return view('preciostienda.create', compact('preciostienda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Preciostienda::$rules);

        $preciostienda = Preciostienda::create($request->all());

        return redirect()->route('preciostiendas.index')
            ->with('success', 'Preciostienda created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preciostienda = Preciostienda::find($id);

        return view('preciostienda.show', compact('preciostienda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preciostienda = Preciostienda::find($id);

        return view('preciostienda.edit', compact('preciostienda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Preciostienda $preciostienda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preciostienda $preciostienda)
    {
        request()->validate(Preciostienda::$rules);

        $preciostienda->update($request->all());

        return redirect()->route('preciostiendas.index')
            ->with('success', 'Preciostienda updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $preciostienda = Preciostienda::find($id)->delete();

        return redirect()->route('preciostiendas.index')
            ->with('success', 'Preciostienda deleted successfully');
    }
}
