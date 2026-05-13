<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Pyme;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horario::with('pyme')->latest()->get();

        return Inertia::render('Horarios/Index', [
            'horarios' => $horarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pymes = Pyme::all();

        return Inertia::render('Horarios/Create', [
            'pymes' => $pymes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pyme_id' => 'required|exists:pymes,id',

            'dia_semana_horarios' => 'required|string|max:255',

            'hora_apertura_horarios' => 'required',

            'hora_cierre_horarios' => 'required',
        ]);

        Horario::create($validated);

        return redirect()
            ->route('horarios.index')
            ->with('success', 'Horario registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        $horario->load('pyme');

        return Inertia::render('Horarios/Show', [
            'horario' => $horario
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        $pymes = Pyme::all();

        return Inertia::render('Horarios/Edit', [
            'horario' => $horario,
            'pymes' => $pymes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        $validated = $request->validate([
            'pyme_id' => 'required|exists:pymes,id',

            'dia_semana_horarios' => 'required|string|max:255',

            'hora_apertura_horarios' => 'required',

            'hora_cierre_horarios' => 'required',
        ]);

        $horario->update($validated);

        return redirect()
            ->route('horarios.index')
            ->with('success', 'Horario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()
            ->route('horarios.index')
            ->with('success', 'Horario eliminado correctamente.');
    }
}
