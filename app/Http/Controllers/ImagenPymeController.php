<?php

namespace App\Http\Controllers;

use App\Models\ImagenPyme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ImagenPymeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagenes = ImagenPyme::with('pyme')->latest()->get();

        return Inertia::render('Imagenes/Index', [
            'imagenes' => $imagenes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Imagenes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pyme_id' => 'required|exists:pymes,id',
            'ruta_imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Guardar imagen
        $path = $request->file('ruta_imagen')->store('pymes', 'public');

        // Crear registro
        ImagenPyme::create([
            'pyme_id' => $validated['pyme_id'],
            'ruta_imagen' => $path,
        ]);

        return redirect()
            ->route('imagenes.index')
            ->with('success', 'Imagen registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ImagenPyme $imagenPyme)
    {
        $imagenPyme->load('pyme');

        return Inertia::render('Imagenes/Show', [
            'imagen' => $imagenPyme
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImagenPyme $imagenPyme)
    {
        return Inertia::render('Imagenes/Edit', [
            'imagen' => $imagenPyme
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImagenPyme $imagenPyme)
    {
        $validated = $request->validate([
            'pyme_id' => 'required|exists:pymes,id',
            'ruta_imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Si sube nueva imagen
        if ($request->hasFile('ruta_imagen')) {

            // Eliminar imagen anterior
            if ($imagenPyme->ruta_imagen) {
                Storage::disk('public')->delete($imagenPyme->ruta_imagen);
            }

            // Guardar nueva imagen
            $path = $request->file('ruta_imagen')->store('pymes', 'public');

            $validated['ruta_imagen'] = $path;
        }

        $imagenPyme->update($validated);

        return redirect()
            ->route('imagenes.index')
            ->with('success', 'Imagen actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImagenPyme $imagenPyme)
    {
        // Eliminar archivo físico
        if ($imagenPyme->ruta_imagen) {
            Storage::disk('public')->delete($imagenPyme->ruta_imagen);
        }

        $imagenPyme->delete();

        return redirect()
            ->route('imagenes.index')
            ->with('success', 'Imagen eliminada correctamente.');
    }
}
