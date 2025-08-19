<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReporteGeneralExport implements WithMultipleSheets
{
    use Exportable;

    protected $departamentoId;
    protected $tipoMantenimiento;
    protected $estadoIncidencia;
    protected $periodo;

    public function __construct($departamentoId = null, $tipoMantenimiento = null, $estadoIncidencia = null, $periodo = null)
    {
        $this->departamentoId = $departamentoId;
        $this->tipoMantenimiento = $tipoMantenimiento;
        $this->estadoIncidencia = $estadoIncidencia;
        $this->periodo = $periodo;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        // Pasa los filtros a las clases de exportación individuales
        $sheets[] = new MantenimientosExport(
            $this->departamentoId,
            $this->tipoMantenimiento,
            $this->periodo
        );
        $sheets[] = new IncidenciasExport(
            $this->departamentoId,
            $this->estadoIncidencia,
            $this->periodo
        );

        return $sheets;
    }
}