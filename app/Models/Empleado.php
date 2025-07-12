<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre_completo',
        'email',
        'telefono',
        'cargo',
        'departamento_id',
        'direccion',
        'genero',
        'fecha_ingreso',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
