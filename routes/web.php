<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Pyme;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'canRegistrarMypes' => Route::has('registrar-mypes'),
    ]);
});

Route::get('/registrar-mypes', function () {
    return Inertia::render('RegistrarMypes');
})->name('registrar-mypes');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/detallepymes', function () {
        return Inertia::render('DetallePymes');
    })->name('detallepymes');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/perfilpymes', function () {
        return Inertia::render('PerfilPymes');
    })->name('perfilpymes');
});

Route::get('/resultados-busqueda', function (Request $request) {

    $busqueda = $request->busqueda;

    $resultados = Pyme::with('categoria')
        ->when($busqueda, function ($query) use ($busqueda) {
            $query->where('nombre_pyme', 'like', "%{$busqueda}%")
                ->orWhere('descripcion_pyme', 'like', "%{$busqueda}%")
                ->orWhere('direccion_pyme', 'like', "%{$busqueda}%");
        })
        ->get();

    return Inertia::render('SearchResults', [
        'resultados' => $resultados,
        'busqueda' => $busqueda,
    ]);
})->name('resultados.busqueda');
