<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Departamento;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
    return view('empleados.create', compact('departamentos'));
    }

    public function store(Request $request)
{
    // Validación (opcional pero recomendado)
    $request->validate([
        'nombre_completo' => 'required',
        'email' => 'required|email|unique:empleados,email',
        'telefono' => 'required',
        'cargo' => 'required',
        'departamento_id' => 'required|exists:departamentos,id',
        'direccion' => 'required',
        'genero' => 'required|in:Masculino,Femenino',
        'fecha_ingreso' => 'required|date',
    ]);

    // Crear el empleado
    Empleado::create([
        'nombre_completo' => $request->nombre_completo,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'cargo' => $request->cargo,
        'departamento_id' => $request->departamento_id,
        'direccion' => $request->direccion,
        'genero' => $request->genero,
        'fecha_ingreso' => $request->fecha_ingreso,
    ]);

    return redirect()->route('empleados.index')->with('success', 'Empleado registrado correctamente');
}

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre_completo' => 'required',
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'telefono' => 'required',
            'cargo' => 'required',
            'departamento' => 'required',
            'direccion' => 'required',
            'genero' => 'required',
            'fecha_ingreso' => 'required|date',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado.');
    }
}