<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Catalogo\TipoMantenimiento;
use Illuminate\Http\Request;

class TipoMantenimientoController extends Controller
{
    public function index()
    {
        $tipos = TipoMantenimiento::orderBy('nombre')->paginate(10);
        return view('catalogo.tipos_mantenimiento.index', compact('tipos'));
    }

    public function create()
    {
        return view('catalogo.tipos_mantenimiento.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:tipo_mantenimientos,nombre|max:255',
        ]);

        TipoMantenimiento::create($request->only('nombre'));

        return redirect()->route('catalogo.tipos_mantenimiento.index')->with('success', 'Tipo de mantenimiento creado.');
    }

    public function edit(TipoMantenimiento $tipos_mantenimiento)
    {
        return view('catalogo.tipos_mantenimiento.edit', compact('tipos_mantenimiento'));
    }

    public function update(Request $request, TipoMantenimiento $tipos_mantenimiento)
    {
        $request->validate([
            'nombre' => 'required|string|unique:tipo_mantenimientos,nombre,'.$tipos_mantenimiento->id.'|max:255',
        ]);

        $tipos_mantenimiento->update($request->only('nombre'));

        return redirect()->route('catalogo.tipos_mantenimiento.index')->with('success', 'Tipo de mantenimiento actualizado.');
    }

    public function destroy(TipoMantenimiento $tipos_mantenimiento)
    {
        $tipos_mantenimiento->delete();
        return redirect()->route('catalogo.tipos_mantenimiento.index')->with('success', 'Tipo de mantenimiento eliminado.');
    }
}
