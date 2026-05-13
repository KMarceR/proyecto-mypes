<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resenas = Resena::with('pyme')->latest()->get();

        return Inertia::render('Resenas/Index', [
            'resenas' => $resenas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Resenas/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pyme_id' => 'required|exists:pymes,id',
            'calificacion_resenas' => 'required|integer|min:1|max:5',
            'comentario_resenas' => 'required|string',
        ]);

        Resena::create($validated);

        return redirect()
            ->route('resenas.index')
            ->with('success', 'Reseña registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resena $resena)
    {
        $resena->load('pyme');

        return Inertia::render('Resenas/Show', [
            'resena' => $resena
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resena $resena)
    {
        return Inertia::render('Resenas/Edit', [
            'resena' => $resena
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resena $resena)
    {
        $validated = $request->validate([
            'pyme_id' => 'required|exists:pymes,id',
            'calificacion_resenas' => 'required|integer|min:1|max:5',
            'comentario_resenas' => 'required|string',
        ]);

        $resena->update($validated);

        return redirect()
            ->route('resenas.index')
            ->with('success', 'Reseña actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resena $resena)
    {
        $resena->delete();

        return redirect()
            ->route('resenas.index')
            ->with('success', 'Reseña eliminada correctamente.');
    }
}
