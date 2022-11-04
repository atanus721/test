<?php

namespace App\Http\Controllers;

use App\Models\Devolucione;
use Illuminate\Http\Request;

/**
 * Class DevolucioneController
 * @package App\Http\Controllers
 */
class DevolucioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devoluciones = Devolucione::paginate();

        return view('devolucione.index', compact('devoluciones'))
            ->with('i', (request()->input('page', 1) - 1) * $devoluciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devolucione = new Devolucione();
        return view('devolucione.create', compact('devolucione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Devolucione::$rules);

        $devolucione = Devolucione::create($request->all());

        return redirect()->route('devoluciones.index')
            ->with('success', 'Devolucione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devolucione = Devolucione::find($id);

        return view('devolucione.show', compact('devolucione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devolucione = Devolucione::find($id);

        return view('devolucione.edit', compact('devolucione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Devolucione $devolucione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devolucione $devolucione)
    {
        request()->validate(Devolucione::$rules);

        $devolucione->update($request->all());

        return redirect()->route('devoluciones.index')
            ->with('success', 'Devolucione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $devolucione = Devolucione::find($id)->delete();

        return redirect()->route('devoluciones.index')
            ->with('success', 'Devolucione deleted successfully');
    }
}
