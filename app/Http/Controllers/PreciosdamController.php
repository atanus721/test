<?php

namespace App\Http\Controllers;

use App\Models\Preciosdam;
use Illuminate\Http\Request;

/**
 * Class PreciosdamController
 * @package App\Http\Controllers
 */
class PreciosdamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preciosdams = Preciosdam::paginate();

        return view('preciosdam.index', compact('preciosdams'))
            ->with('i', (request()->input('page', 1) - 1) * $preciosdams->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $preciosdam = new Preciosdam();
        return view('preciosdam.create', compact('preciosdam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Preciosdam::$rules);

        $preciosdam = Preciosdam::create($request->all());

        return redirect()->route('preciosdams.index')
            ->with('success', 'Preciosdam created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preciosdam = Preciosdam::find($id);

        return view('preciosdam.show', compact('preciosdam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preciosdam = Preciosdam::find($id);

        return view('preciosdam.edit', compact('preciosdam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Preciosdam $preciosdam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preciosdam $preciosdam)
    {
        request()->validate(Preciosdam::$rules);

        $preciosdam->update($request->all());

        return redirect()->route('preciosdams.index')
            ->with('success', 'Preciosdam updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $preciosdam = Preciosdam::find($id)->delete();

        return redirect()->route('preciosdams.index')
            ->with('success', 'Preciosdam deleted successfully');
    }
}
