<?php

namespace App\Http\Controllers;

use App\Models\Embarquemateriale;
use Illuminate\Http\Request;

/**
 * Class EmbarquematerialeController
 * @package App\Http\Controllers
 */
class EmbarquematerialeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $embarquemateriales = Embarquemateriale::paginate();

        return view('embarquemateriale.index', compact('embarquemateriales'))
            ->with('i', (request()->input('page', 1) - 1) * $embarquemateriales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $embarquemateriale = new Embarquemateriale();
        return view('embarquemateriale.create', compact('embarquemateriale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Embarquemateriale::$rules);

        $embarquemateriale = Embarquemateriale::create($request->all());

        return redirect()->route('embarquemateriales.index')
            ->with('success', 'Embarquemateriale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $embarquemateriale = Embarquemateriale::find($id);

        return view('embarquemateriale.show', compact('embarquemateriale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $embarquemateriale = Embarquemateriale::find($id);

        return view('embarquemateriale.edit', compact('embarquemateriale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Embarquemateriale $embarquemateriale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Embarquemateriale $embarquemateriale)
    {
        request()->validate(Embarquemateriale::$rules);

        $embarquemateriale->update($request->all());

        return redirect()->route('embarquemateriales.index')
            ->with('success', 'Embarquemateriale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $embarquemateriale = Embarquemateriale::find($id)->delete();

        return redirect()->route('embarquemateriales.index')
            ->with('success', 'Embarquemateriale deleted successfully');
    }
}
