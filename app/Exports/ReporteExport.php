<?php

namespace App\Exports;

use App\Models\Incidencia;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReporteExport implements FromCollection
{
    public function collection()
    {
        return Incidencia::all(); // puedes modificar la consulta
    }
}
