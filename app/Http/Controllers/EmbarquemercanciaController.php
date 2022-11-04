<?php

namespace App\Http\Controllers;

use App\Models\Embarquemercancia;
use Illuminate\Http\Request;

/**
 * Class EmbarquemercanciaController
 * @package App\Http\Controllers
 */
class EmbarquemercanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $embarquemercancias = Embarquemercancia::paginate();

        return view('embarquemercancia.index', compact('embarquemercancias'))
            ->with('i', (request()->input('page', 1) - 1) * $embarquemercancias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $embarquemercancia = new Embarquemercancia();
        return view('embarquemercancia.create', compact('embarquemercancia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Embarquemercancia::$rules);

        $embarquemercancia = Embarquemercancia::create($request->all());

        return redirect()->route('embarquemercancias.index')
            ->with('success', 'Embarquemercancia created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $embarquemercancia = Embarquemercancia::find($id);

        return view('embarquemercancia.show', compact('embarquemercancia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $embarquemercancia = Embarquemercancia::find($id);

        return view('embarquemercancia.edit', compact('embarquemercancia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Embarquemercancia $embarquemercancia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Embarquemercancia $embarquemercancia)
    {
        request()->validate(Embarquemercancia::$rules);

        $embarquemercancia->update($request->all());

        return redirect()->route('embarquemercancias.index')
            ->with('success', 'Embarquemercancia updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $embarquemercancia = Embarquemercancia::find($id)->delete();

        return redirect()->route('embarquemercancias.index')
            ->with('success', 'Embarquemercancia deleted successfully');
    }
}
