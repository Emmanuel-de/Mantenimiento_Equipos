<?php


namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Incidencia;
use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        // Obtener equipos con la relación departamento para no hacer consultas repetidas
        $equipos = Equipo::with('departamento')->get();

        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        // Obtener departamentos para el select del formulario
        $departamentos = Departamento::all();
    $empleados = Empleado::all();

    return view('equipos.create', compact('departamentos', 'empleados'));
    }

    public function edit(Empleado $empleado)
{
    return view('empleados.edit', compact('empleado'));
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'departamento_id' => 'required|exists:departamentos,id',
        'empleado_id' => 'required|exists:empleados,id',
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'tipo_equipo' => 'required|in:Laptop,PC de escritorio',
        'memoria_ram' => 'required|string|max:255',
        'disco_duro' => 'required|string|max:255',
        'tipo_disco' => 'required|in:SSD,HDD',
        'procesador' => 'required|string|max:255',
        'numero_serie' => 'required|string|max:255|unique:equipos',
        'fecha_adquisicion' => 'required|date',
        'estado' => 'required|in:Activo,Inactivo,Mantenimiento',
    ]);

    // 👇 Agregamos el nombre completo del empleado al campo 'responsable'
    $empleado = Empleado::findOrFail($validated['empleado_id']);
    $validated['responsable'] = $empleado->nombre_completo;

    Equipo::create($validated);

    return redirect()->route('equipos.index')->with('success', 'Equipo registrado correctamente.');
}

public function incidencias(Equipo $equipo)
{
    $incidencias = $equipo->incidencias()->latest('fecha')->get();
    return view('equipos.incidencias', compact('equipo', 'incidencias'));
}

public function historial(Equipo $equipo)
{
    $mantenimientos = $equipo->mantenimientos()->latest()->get();
    return view('equipos.historial', compact('equipo', 'mantenimientos'));
}

}

