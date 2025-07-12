<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Departamento;
use App\Models\Mantenimiento;
use App\Models\Incidencia;
use Carbon\Carbon;

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
        $mantenimientos = Mantenimiento::with('equipo');

        if ($departamentoId) {
            $mantenimientos->whereHas('equipo', function ($q) use ($departamentoId) {
                $q->where('departamento_id', $departamentoId);
            });
        }

        if ($tipoMantenimiento) {
            $mantenimientos->where('tipo', $tipoMantenimiento);
        }

        if ($fechaInicio) {
            $mantenimientos->whereDate('fecha', '>=', $fechaInicio);
        }

        $mantenimientos = $mantenimientos->get();

        // ====================
        // FILTROS INCIDENCIAS
        // ====================
        $incidencias = Incidencia::with('equipo');

        if ($departamentoId) {
            $incidencias->whereHas('equipo', function ($q) use ($departamentoId) {
                $q->where('departamento_id', $departamentoId);
            });
        }

        if ($estadoIncidencia) {
            $incidencias->where('estado', $estadoIncidencia);
        }

        if ($fechaInicio) {
            $incidencias->whereDate('fecha', '>=', $fechaInicio);
        }

        $incidencias = $incidencias->get();

        // ====================
        // Departamentos (para el filtro)
        // ====================
        $departamentos = Departamento::all();

        return view('reportes.index', compact('mantenimientos', 'incidencias', 'departamentos'));
    }
}
