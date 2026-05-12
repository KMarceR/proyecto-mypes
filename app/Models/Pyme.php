<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pyme extends Model
{
    /** @use HasFactory<\Database\Factories\PymeFactory> */
    use HasFactory;

    protected $table = 'pymes';

    protected $fillable = [
        'user_id',
        'categoria_id',
        'nombre_pyme',
        'telefono_pyme',
        'email_pyme',
        'direccion_pyme',
        'descripcion_pyme',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    // Usuario dueño
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
