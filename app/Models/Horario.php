<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'pyme_id',
        'dia_semana_horarios',
        'hora_apertura_horarios',
        'hora_cierre_horarios',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function pyme()
    {
        return $this->belongsTo(Pyme::class);
    }
}
