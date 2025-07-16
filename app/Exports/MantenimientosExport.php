<?php

namespace App\Exports;

use App\Models\Mantenimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; // <-- Importa WithMapping
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;

class MantenimientosExport implements FromCollection, WithHeadings, WithTitle, WithMapping // <-- Añade WithMapping
{
    protected $departamentoId;
    protected $tipoMantenimiento; // Este es el NOMBRE del tipo, no el ID
    protected $periodo;

    public function __construct($departamentoId = null, $tipoMantenimiento = null, $periodo = null)
    {
        $this->departamentoId = $departamentoId;
        $this->tipoMantenimiento = $tipoMantenimiento;
        $this->periodo = $periodo;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Usamos with(['equipo', 'tipo_mantenimiento']) para cargar las relaciones
        $mantenimientos = Mantenimiento::with(['equipo', 'tipo_mantenimiento']);

        if ($this->departamentoId) {
            $mantenimientos->whereHas('equipo', function ($q) {
                $q->where('departamento_id', $this->departamentoId);
            });
        }

        // Aquí filtramos por el nombre del tipo de mantenimiento (si se seleccionó en el filtro)
        if ($this->tipoMantenimiento) {
            $mantenimientos->whereHas('tipo_mantenimiento', function($q) {
                $q->where('nombre', $this->tipoMantenimiento); // Asumiendo que el campo es 'nombre' en TipoMantenimiento
            });
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
            $mantenimientos->whereDate('fecha', '>=', $fechaInicio);
        }

        return $mantenimientos->get();
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
            'Tipo de Mantenimiento', // Nombre del tipo de mantenimiento
            'Fecha',
            'Descripción',
            'Refacciones',
            'Responsable',
            'Evidencia',
            'Creado En',
            'Actualizado En',
        ];
    }

    /**
     * Mapea los datos de cada fila para que coincidan con los encabezados.
     * @param mixed $mantenimiento
     * @return array
     */
    public function map($mantenimiento): array
    {
        return [
            $mantenimiento->id,
            $mantenimiento->equipo->nombre ?? 'N/A', // Accede al nombre del equipo
            $mantenimiento->tipo_mantenimiento->nombre ?? 'N/A', // Accede al nombre del tipo de mantenimiento
            $mantenimiento->fecha ? Carbon::parse($mantenimiento->fecha)->format('d/m/Y') : '', // Formatea la fecha
            $mantenimiento->descripcion,
            $mantenimiento->refacciones,
            $mantenimiento->responsable,
            $mantenimiento->evidencia,
            $mantenimiento->created_at ? Carbon::parse($mantenimiento->created_at)->format('d/m/Y H:i:s') : '',
            $mantenimiento->updated_at ? Carbon::parse($mantenimiento->updated_at)->format('d/m/Y H:i:s') : '',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Mantenimientos';
    }
}
