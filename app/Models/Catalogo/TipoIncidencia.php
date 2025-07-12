<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncidencia extends Model
{
    use HasFactory;

    protected $table = 'tipos_incidencias';

    protected $fillable = [
        'nombre',
    ];
}