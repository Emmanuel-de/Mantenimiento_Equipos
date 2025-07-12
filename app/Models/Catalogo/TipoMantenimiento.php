<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMantenimiento extends Model
{
    use HasFactory;

    protected $table = 'tipo_mantenimientos';

    protected $fillable = ['nombre'];
}
