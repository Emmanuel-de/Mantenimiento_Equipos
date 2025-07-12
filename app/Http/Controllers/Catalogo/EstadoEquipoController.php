<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogo\EstadoEquipo;
use App\Models\Equipo;


class EstadoEquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::select('numero_serie', 'marca', 'modelo', 'estado')->get();

        return view('catalogo.estados_equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('catalogo.estados_equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:100|unique:estados_equipos,nombre']);

        EstadoEquipo::create($request->only('nombre'));

        return redirect()->route('catalogo.estados_equipos.index')->with('success', 'Estado creado correctamente.');
    }

    public function edit(EstadoEquipo $estado)
    {
        return view('catalogo.estados_equipos.edit', compact('estado'));
    }

    public function update(Request $request, EstadoEquipo $estado)
    {
        $request->validate(['nombre' => 'required|string|max:100|unique:estados_equipos,nombre,' . $estado->id]);

        $estado->update($request->only('nombre'));

        return redirect()->route('catalogo.estados_equipos.index')->with('success', 'Estado actualizado.');
    }

    public function destroy(EstadoEquipo $estado)
    {
        $estado->delete();
        return redirect()->route('catalogo.estados_equipos.index')->with('success', 'Estado eliminado.');
    }
}
