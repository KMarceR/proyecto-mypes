<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenPyme extends Model
{
    /** @use HasFactory<\Database\Factories\ImagenPymeFactory> */
    use HasFactory;

    protected $table = 'imagen_pymes';

    protected $fillable = [
        'pyme_id',
        'ruta_imagen',
    ];

    /**
     * Relación: una imagen pertenece a una PYME
     */
    public function pyme()
    {
        return $this->belongsTo(Pyme::class);
    }
}
