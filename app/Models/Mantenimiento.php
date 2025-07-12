<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
    'equipo_id',
    'fecha',
    'tipo_mantenimiento_id',
    'descripcion',
    'refacciones',
    'responsable',
    'evidencia',
];


    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function tipo_mantenimiento()
{
    return $this->belongsTo(\App\Models\Catalogo\TipoMantenimiento::class, 'tipo_mantenimiento_id');
}

public function empleado()
{
    return $this->belongsTo(Empleado::class, 'empleado_id');
}



}
