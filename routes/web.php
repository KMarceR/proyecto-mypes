<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
