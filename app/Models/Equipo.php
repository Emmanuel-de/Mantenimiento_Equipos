<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
    'departamento_id',
    'empleado_id',
    'responsable', // 👈 Asegúrate de incluir esto
    'marca',
    'modelo',
    'tipo_equipo',
    'memoria_ram',
    'disco_duro',
    'tipo_disco',
    'procesador',
    'numero_serie',
    'fecha_adquisicion',
    'estado',
];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function mantenimientos()
{
    return $this->hasMany(Mantenimiento::class);
}

public function equipo()
{
    return $this->belongsTo(Equipo::class);
}

public function incidencias()
{
    return $this->hasMany(Incidencia::class);
}

public function getNombreAttribute()
{
    return $this->marca . ' ' . $this->modelo . ' - ' . $this->numero_serie;
}

public function estadoEquipo()
{
    return $this->belongsTo(\App\Models\Catalogo\EstadoEquipo::class, 'estado_id');
}

}
