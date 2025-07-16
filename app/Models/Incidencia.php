<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'tipo_incidencia_id',
        'fecha',
        'fecha_reporte',
        'descripcion',
        'reportado_por',
        'estado',
        'solucion',
        'tecnico',
        'evidencia',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_reporte' => 'date',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function tipoIncidencia()
    {
        return $this->belongsTo(\App\Models\Catalogo\TipoIncidencia::class, 'tipo_incidencia_id');
    }
}


