<?php

namespace App\Http\Controllers;

use App\Models\Pyme;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PymeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pymes = Pyme::with([
            'user',
            'categoria',
            'horarios'
        ])->latest()->get();

        return Inertia::render('Pymes/Index', [
            'pymes' => $pymes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Pymes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria_id' => 'required|integer',
            'nombre_pyme' => 'required|string|max:255',
            'telefono_pyme' => 'required|string|max:20',
            'email_pyme' => 'required|email|max:255',
            'direccion_pyme' => 'required|string',
            'descripcion_pyme' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        Pyme::create($validated);

        return redirect()
            ->route('pymes.index')
            ->with('success', 'PYME registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pyme $pyme)
    {
        $pyme->load([
            'categoria',
            'horarios',
            'resenas'
        ]);

        return Inertia::render('Pymes/Show', [
            'pyme' => $pyme
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pyme $pyme)
    {
        return Inertia::render('Pymes/Edit', [
            'pyme' => $pyme
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pyme $pyme)
    {
        $validated = $request->validate([
            'categoria_id' => 'required|integer',
            'nombre_pyme' => 'required|string|max:255',
            'telefono_pyme' => 'required|string|max:20',
            'email_pyme' => 'required|email|max:255',
            'direccion_pyme' => 'required|string',
            'descripcion_pyme' => 'required|string',
        ]);

        $pyme->update($validated);

        return redirect()
            ->route('pymes.index')
            ->with('success', 'PYME actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pyme $pyme)
    {
        $pyme->delete();

        return redirect()
            ->route('pymes.index')
            ->with('success', 'PYME eliminada correctamente.');
    }
}
