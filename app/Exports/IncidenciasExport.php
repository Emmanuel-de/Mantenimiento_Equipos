<?php

namespace App\Exports;

use App\Models\Incidencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; // <-- Importa WithMapping
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;

class IncidenciasExport implements FromCollection, WithHeadings, WithTitle, WithMapping // <-- Añade WithMapping
{
    protected $departamentoId;
    protected $estadoIncidencia;
    protected $periodo;

    public function __construct($departamentoId = null, $estadoIncidencia = null, $periodo = null)
    {
        $this->departamentoId = $departamentoId;
        $this->estadoIncidencia = $estadoIncidencia;
        $this->periodo = $periodo;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Usamos with(['equipo', 'tipoIncidencia']) para cargar las relaciones
        $incidencias = Incidencia::with(['equipo', 'tipoIncidencia']);

        if ($this->departamentoId) {
            $incidencias->whereHas('equipo', function ($q) {
                $q->where('departamento_id', $this->departamentoId);
            });
        }

        // Aquí filtramos por el estado de la incidencia (campo directo en Incidencia)
        if ($this->estadoIncidencia) {
            $incidencias->where('estado', $this->estadoIncidencia);
        }

        // Filtro de fechas
        $fechaInicio = null;
        if ($this->periodo === 'semanal') {
            $fechaInicio = Carbon::now()->subWeek();
        } elseif ($this->periodo === 'mensual') {
            $fechaInicio = Carbon::now()->startOfMonth();
        } elseif ($this->periodo === 'anual') {
            $fechaInicio = Carbon::now()->startOfYear();
        }

        if ($fechaInicio) {
            $incidencias->whereDate('fecha', '>=', $fechaInicio);
        }

        return $incidencias->get();
    }

    /**
     * Define los encabezados de las columnas en tu archivo Excel.
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Equipo', // Nombre del equipo
            'Tipo de Incidencia', // Nombre del tipo de incidencia
            'Fecha Incidencia',
            'Fecha Reporte',
            'Descripción',
            'Reportado Por',
            'Estado',
            'Solución',
            'Técnico',
            'Evidencia',
            'Creado En',
            'Actualizado En',
        ];
    }

    /**
     * Mapea los datos de cada fila para que coincidan con los encabezados.
     * @param mixed $incidencia
     * @return array
     */
    public function map($incidencia): array
    {
        return [
            $incidencia->id,
            $incidencia->equipo->nombre ?? 'N/A', // Accede al nombre del equipo
            $incidencia->tipoIncidencia->nombre ?? 'N/A', // Accede al nombre del tipo de incidencia
            $incidencia->fecha ? Carbon::parse($incidencia->fecha)->format('d/m/Y') : '', // Formatea la fecha de incidencia
            $incidencia->fecha_reporte ? Carbon::parse($incidencia->fecha_reporte)->format('d/m/Y') : '', // Formatea la fecha de reporte
            $incidencia->descripcion,
            $incidencia->reportado_por,
            $incidencia->estado,
            $incidencia->solucion,
            $incidencia->tecnico,
            $incidencia->evidencia,
            $incidencia->created_at ? Carbon::parse($incidencia->created_at)->format('d/m/Y H:i:s') : '',
            $incidencia->updated_at ? Carbon::parse($incidencia->updated_at)->format('d/m/Y H:i:s') : '',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Incidencias';
    }
}