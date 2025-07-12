<?php
namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with('equipo')->orderByDesc('fecha')->get();
        return view('incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        return view('incidencias.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'reportado_por' => 'required|string',
            'estado' => 'required|in:Abierta,En proceso,Cerrada',
            'solucion' => 'nullable|string',
            'tecnico' => 'nullable|string',
            'evidencia' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            $data['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
        }

        Incidencia::create($data);
        return redirect()->route('incidencias.index')->with('success', 'Incidencia registrada correctamente.');
    }

    public function show(Incidencia $incidencia)
    {
        return view('incidencias.show', compact('incidencia'));
    }

    public function edit(Incidencia $incidencia)
    {
        $equipos = Equipo::all();
        return view('incidencias.edit', compact('incidencia', 'equipos'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        $data = $request->validate([
            'equipo_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'reportado_por' => 'required|string',
            'estado' => 'required|in:Abierta,En proceso,Cerrada',
            'solucion' => 'nullable|string',
            'tecnico' => 'nullable|string',
            'evidencia' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            if ($incidencia->evidencia) {
                Storage::disk('public')->delete($incidencia->evidencia);
            }
            $data['evidencia'] = $request->file('evidencia')->store('evidencias', 'public');
        }

        $incidencia->update($data);
        return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada.');
    }

    public function destroy(Incidencia $incidencia)
    {
        if ($incidencia->evidencia) {
            Storage::disk('public')->delete($incidencia->evidencia);
        }
        $incidencia->delete();
        return redirect()->route('incidencias.index')->with('success', 'Incidencia eliminada.');
    }
}