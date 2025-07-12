<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEquipo extends Model
{
    use HasFactory;

    protected $table = 'estados_equipos';

    protected $fillable = [
        'nombre',
    ];
}
