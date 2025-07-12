<?php

// app/Http/Controllers/DepartamentoController.php
namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::all();
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:departamentos,nombre',
        ]);

        Departamento::create($request->only('nombre'));

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento creado correctamente.');
    }

    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return redirect()->route('departamentos.index')
            ->with('success', 'Departamento eliminado correctamente.');
    }

    // Opcional: show, edit, update si quieres editar departamentos
}
