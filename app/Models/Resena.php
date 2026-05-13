<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    /** @use HasFactory<\Database\Factories\ResenaFactory> */
    use HasFactory;

    protected $table = 'resenas';

    protected $fillable = [
        'pyme_id',
        'calificacion_resenas',
        'comentario_resenas',
    ];

    /**
     * Relación: una reseña pertenece a una PYME
     */
    public function pyme()
    {
        return $this->belongsTo(Pyme::class);
    }
}
