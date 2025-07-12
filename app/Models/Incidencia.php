<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'fecha',
        'descripcion',
        'reportado_por',
        'estado',
        'solucion',
        'tecnico',
        'evidencia',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}

