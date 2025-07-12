<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\Catalogo\TipoIncidencia;
use Illuminate\Http\Request;

class TipoIncidenciaController extends Controller
{
    public function index()
    {
        $tipos = TipoIncidencia::orderBy('nombre')->get();
        return view('catalogo.tipos_incidencias.index', compact('tipos'));
    }

    public function create()
    {
        return view('catalogo.tipos_incidencias.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|unique:tipos_incidencias,nombre']);
        TipoIncidencia::create($request->only('nombre'));

        return redirect()->route('catalogo.tipos_incidencias.index')->with('success', 'Tipo agregado.');
    }

    public function edit(TipoIncidencia $tipos_incidencia)
    {
        return view('catalogo.tipos_incidencias.edit', ['tipo' => $tipos_incidencia]);
    }

    public function update(Request $request, TipoIncidencia $tipos_incidencia)
    {
        $request->validate(['nombre' => 'required|unique:tipos_incidencias,nombre,' . $tipos_incidencia->id]);
        $tipos_incidencia->update($request->only('nombre'));

        return redirect()->route('catalogo.tipos_incidencias.index')->with('success', 'Tipo actualizado.');
    }

    public function destroy(TipoIncidencia $tipos_incidencia)
    {
        $tipos_incidencia->delete();
        return back()->with('success', 'Tipo eliminado.');
    }
}
