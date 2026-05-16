<?php

use App\Http\Controllers\PymeController;
use App\Models\Categoria;
use App\Models\Resena;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Pyme;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'canLogin'          => Route::has('login'),
        'canRegister'       => Route::has('register'),
        'canRegistrarMypes' => Route::has('registrar-mypes'),
        'categorias'        => Categoria::all(),
        'pymes'             => Pyme::with(['categoria', 'resenas', 'imagenes'])->latest()->take(5)->get(),
        'resenas'           => Resena::with('pyme')->latest()->take(5)->get(),
    ]);
})->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/registrar-mypes', function () {
        $pyme = Pyme::where('user_id', auth()->user()->id)->first();

        if($pyme) {
            return redirect()->route('detallepymes')->with('error', 'Ya tienes una pyme registrada. No puedes registrar otra.');
        }


        return Inertia::render('RegistrarMypes', [
            'categorias' => Categoria::all(),
        ]);
    })->name('registrar-mypes');


    Route::get('/detallepymes', function () {
        $pyme = Pyme::where('user_id', auth()->user()->id)
            ->with(['categoria', 'imagenes'])
            ->first();
        return Inertia::render('DetallePymes', [
            'categorias' => Categoria::all(),
            'pyme'       => $pyme,
        ]);
    })->name('detallepymes');


    Route::get('/perfilpymes', function () {
        $pyme = Pyme::with([
            'categoria',
            'horarios',
            'resenas',
            'imagenes',
        ])->where('user_id', auth()->user()->id)->first();

        if(!$pyme) {
            return redirect()->route('detallepymes')->with('error', 'No tienes una pyme registrada. Por favor, regístrala primero.');
        }

        return Inertia::render('Pymes/Show', [
            'pyme' => $pyme
        ]);
    })->name('perfilpymes');

    Route::post('/pymes/{pyme}/resenas', function (Request $request, Pyme $pyme) {
        $request->validate([
            'calificacion_resenas' => 'required|integer|min:1|max:5',
            'comentario_resenas'   => 'required|string|max:1000',
        ]);

        $pyme->resenas()->create([
            'calificacion_resenas' => $request->calificacion_resenas,
            'comentario_resenas'   => $request->comentario_resenas,
        ]);

        return redirect()->route('pymes.show', $pyme)->with('success', 'Reseña publicada.');
    })->name('pymes.resenas.store');

    Route::resource('pymes', PymeController::class)->except(['show']);


});

Route::get('/pymes/{pyme}', [PymeController::class, 'show'])->name('pymes.show');


Route::get('/resultados-busqueda', function (Request $request) {

    $busqueda = $request->busqueda;
    $categoriaId = $request->category;
    $orderBy = $request->order_by;

    $resultados = Pyme::with(['categoria', 'resenas', 'imagenes'])
        ->when($busqueda, function ($query) use ($busqueda) {
            $query->where('nombre_pyme', 'like', "%{$busqueda}%")
                ->orWhere('descripcion_pyme', 'like', "%{$busqueda}%")
                ->orWhere('direccion_pyme', 'like', "%{$busqueda}%");
        })
        ->when($categoriaId, function ($query) use ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        })
        ->when($orderBy === 'recientes', function ($query) {
            $query->orderBy('created_at', 'desc');
        })
        ->when($orderBy === 'mejor_valoradas', function ($query) {
            $query->withAvg('resenas', 'calificacion_resenas')
                  ->orderBy('resenas_avg_calificacion_resenas', 'desc');
        })
        ->when($orderBy === 'populares', function ($query) {
            $query->withCount('resenas')
                  ->orderBy('resenas_count', 'desc');
        })
        ->get();

    return Inertia::render('Busqueda', [
        'resultados' => $resultados,
        'busqueda' => $busqueda,
        'categorias' => Categoria::all(),
        'selectedCategory' => $categoriaId,
        'selectedOrderBy' => $orderBy,
    ]);
})->name('resultados.busqueda');
