<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;

/**
 * Class PrecioController
 * @package App\Http\Controllers
 */
class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precios = Precio::paginate();

        return view('precio.index', compact('precios'))
            ->with('i', (request()->input('page', 1) - 1) * $precios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precio = new Precio();
        return view('precio.create', compact('precio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Precio::$rules);

        $precio = Precio::create($request->all());

        return redirect()->route('precios.index')
            ->with('success', 'Precio created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $precio = Precio::find($id);

        return view('precio.show', compact('precio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $precio = Precio::find($id);

        return view('precio.edit', compact('precio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Precio $precio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precio $precio)
    {
        request()->validate(Precio::$rules);

        $precio->update($request->all());

        return redirect()->route('precios.index')
            ->with('success', 'Precio updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $precio = Precio::find($id)->delete();

        return redirect()->route('precios.index')
            ->with('success', 'Precio deleted successfully');
    }
}
