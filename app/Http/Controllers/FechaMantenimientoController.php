<?php

namespace App\Http\Controllers;

use App\Models\FechaMantenimiento;
use App\Models\Equipo;
use Illuminate\Http\Request;

class FechaMantenimientoController extends Controller
{
    public function index()
    {
        $fechas = FechaMantenimiento::with('equipo')->orderBy('fecha_programada', 'desc')->get();
        return view('fecha_mantenimientos.index', compact('fechas'));
    }

    public function create()
    {
        $equipos = Equipo::orderBy('numero_serie')->get();
        return view('fecha_mantenimientos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'fecha_programada' => 'required|date',
            'responsable' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        FechaMantenimiento::create($request->all());

        return redirect()->route('fecha-mantenimientos.index')->with('success', 'Fecha de mantenimiento registrada correctamente.');
    }
}
