<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Departamento;
use App\Models\Mantenimiento;
use App\Models\Incidencia;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel; // Asegúrate de tener esta línea
use App\Exports\ReporteGeneralExport; // Asegúrate de tener esta línea
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $departamentoId = $request->input('departamento_id');
        $tipoMantenimiento = $request->input('tipo_mantenimiento');
        $estadoIncidencia = $request->input('estado_incidencia');
        $periodo = $request->input('periodo');

        // Filtro de fechas
        $fechaInicio = null;
        if ($periodo === 'semanal') {
            $fechaInicio = Carbon::now()->subWeek();
        } elseif ($periodo === 'mensual') {
            $fechaInicio = Carbon::now()->startOfMonth();
        } elseif ($periodo === 'anual') {
            $fechaInicio = Carbon::now()->startOfYear();
        }

        // ====================
        // FILTROS MANTENIMIENTO
        // ====================
        $mantenimientosQuery = Mantenimiento::with('equipo'); // Usamos una variable query para poder encadenar

        if ($departamentoId) {
            $mantenimientosQuery->whereHas('equipo', function ($q) use ($departamentoId) {
                $q->where('departamento_id', $departamentoId);
            });
        }

        if ($tipoMantenimiento) {
            $mantenimientosQuery->where('tipo', $tipoMantenimiento);
        }

        if ($fechaInicio) {
            $mantenimientosQuery->whereDate('fecha', '>=', $fechaInicio);
        }

        $mantenimientos = $mantenimientosQuery->get(); // Obtener los resultados al final

        // ====================
        // FILTROS INCIDENCIAS
        // ====================
        $incidenciasQuery = Incidencia::with('equipo'); // Usamos una variable query

        if ($departamentoId) {
            $incidenciasQuery->whereHas('equipo', function ($q) use ($departamentoId) {
                $q->where('departamento_id', $departamentoId);
            });
        }

        if ($estadoIncidencia) {
            $incidenciasQuery->where('estado', $estadoIncidencia);
        }

        if ($fechaInicio) {
            $incidenciasQuery->whereDate('fecha', '>=', $fechaInicio);
        }

        $incidencias = $incidenciasQuery->get(); // Obtener los resultados al final

        // ====================
        // Departamentos (para el filtro)
        // ====================
        $departamentos = Departamento::all();

        return view('reportes.index', compact('mantenimientos', 'incidencias', 'departamentos'));
    }

    public function exportarReporteGeneralExcel(Request $request) // <--- Aquí pasamos el Request
    {
        $departamentoId = $request->input('departamento_id');
        $tipoMantenimiento = $request->input('tipo_mantenimiento');
        $estadoIncidencia = $request->input('estado_incidencia');
        $periodo = $request->input('periodo');

        // Pasa los filtros a la clase de exportación principal
        return Excel::download(
            new ReporteGeneralExport($departamentoId, $tipoMantenimiento, $estadoIncidencia, $periodo),
            'reporte_general.xlsx'
        );
    }

    public function exportPdf()
    {
        $mantenimientos = Mantenimiento::all(); // Obtén tus datos de Mantenimientos
        $incidencias = Incidencia::all(); // Obtén tus datos de Incidencias

        $data = [
            'mantenimientos' => $mantenimientos,
            'incidencias' => $incidencias
        ];

        $pdf = Pdf::loadView('pdf.reporte_incidencias', $data);

        // Puedes descargar el PDF directamente o mostrarlo en el navegador
        return $pdf->download('reporte_general.pdf'); // Descargar el archivo
        // return $pdf->stream('reporte_general.pdf'); // Mostrar en el navegador
    }
}
