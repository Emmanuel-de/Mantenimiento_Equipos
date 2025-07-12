<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechaMantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'fecha_programada',
        'responsable',
        'observaciones',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
