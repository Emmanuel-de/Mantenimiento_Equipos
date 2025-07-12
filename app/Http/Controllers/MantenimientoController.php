<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MantenimientoController extends Controller
{
    /**
     * Mostrar lista de mantenimientos.
     */
    public function index()
    {
        $mantenimientos = Mantenimiento::with('equipo')->get();
        return view('mantenimiento.index', compact('mantenimientos'));
    }

    /**
     * Mostrar formulario para crear nuevo mantenimiento.
     */
    public function create()
    {
        $equipos = Equipo::orderBy('numero_serie')->get();
        return view('mantenimiento.create', compact('equipos'));
    }

    /**
     * Guardar un nuevo mantenimiento.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'tipo_mantenimiento_id' => 'required|exists:tipo_mantenimientos,id',
            'descripcion' => 'required|string',
            'refacciones' => 'nullable|string',
            'responsable' => 'required|string|max:255',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            $validated['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
        }

        Mantenimiento::create($validated);

        return redirect()->route('mantenimiento.index')->with('success', 'Mantenimiento registrado correctamente.');
    }

    /**
     * Mostrar un mantenimiento específico.
     */
    public function show(Mantenimiento $mantenimiento)
    {
        return view('mantenimiento.show', compact('mantenimiento'));
    }

    /**
     * Mostrar formulario para editar mantenimiento.
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        $equipos = Equipo::all();
        return view('mantenimiento.edit', compact('mantenimiento', 'equipos'));
    }

    /**
     * Actualizar mantenimiento.
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $validated = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'tipo_mantenimiento_id' => 'required|exists:tipo_mantenimientos,id',
            'descripcion' => 'required|string',
            'refacciones' => 'nullable|string',
            'responsable' => 'required|string|max:255',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            if ($mantenimiento->evidencia) {
                Storage::disk('public')->delete($mantenimiento->evidencia);
            }

            $validated['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
        }

        $mantenimiento->update($validated);

        return redirect()->route('mantenimiento.index')->with('success', 'Mantenimiento actualizado correctamente.');
    }

    /**
     * Eliminar mantenimiento.
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        if ($mantenimiento->evidencia) {
            Storage::disk('public')->delete($mantenimiento->evidencia);
        }

        $mantenimiento->delete();

        return redirect()->route('mantenimiento.index')->with('success', 'Mantenimiento eliminado correctamente.');
    }

    /**
     * Historial de mantenimientos por equipo.
     */
    public function historial(Equipo $equipo)
    {
        $mantenimientos = $equipo->mantenimientos()
            ->with('tipo_mantenimiento')  // carga la relación para la vista
            ->latest()
            ->get();

        return view('historial.index', compact('equipo', 'mantenimientos'));
    }
}
