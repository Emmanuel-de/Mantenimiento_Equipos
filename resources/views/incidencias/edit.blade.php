@extends('layouts.app')

@section('title', 'Editar Incidencia')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Editar Incidencia</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('incidencias.update', $incidencia) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="equipo_id" class="block text-gray-700 font-medium mb-1">Equipo</label>
            <select name="equipo_id" id="equipo_id" class="w-full border rounded px-3 py-2">
    <option value="">Seleccione un equipo</option>
    @foreach ($equipos as $equipo)
        <option value="{{ $equipo->id }}" {{ (old('equipo_id', $incidencia->equipo_id ?? '') == $equipo->id) ? 'selected' : '' }}>
            {{ $equipo->nombre }} - {{ $equipo->numero_serie }}
        </option>
    @endforeach
</select>
        </div>

        <div>
            <label for="fecha" class="block text-gray-700 font-medium mb-1">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $incidencia->fecha) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="descripcion" class="block text-gray-700 font-medium mb-1">Descripción del problema</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 resize-y focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('descripcion', $incidencia->descripcion) }}</textarea>
        </div>

        <div>
            <label for="reportado_por" class="block text-gray-700 font-medium mb-1">Reportado por</label>
            <input type="text" name="reportado_por" id="reportado_por" value="{{ old('reportado_por', $incidencia->reportado_por) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="estado" class="block text-gray-700 font-medium mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="Abierta" {{ (old('estado', $incidencia->estado) == 'Abierta') ? 'selected' : '' }}>Abierta</option>
                <option value="En proceso" {{ (old('estado', $incidencia->estado) == 'En proceso') ? 'selected' : '' }}>En proceso</option>
                <option value="Cerrada" {{ (old('estado', $incidencia->estado) == 'Cerrada') ? 'selected' : '' }}>Cerrada</option>
            </select>
        </div>

        <div>
            <label for="solucion" class="block text-gray-700 font-medium mb-1">Solución aplicada</label>
            <textarea name="solucion" id="solucion" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 resize-y focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('solucion', $incidencia->solucion) }}</textarea>
        </div>

        <div>
            <label for="tecnico" class="block text-gray-700 font-medium mb-1">Técnico que atendió</label>
            <input type="text" name="tecnico" id="tecnico" value="{{ old('tecnico', $incidencia->tecnico) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="evidencia" class="block text-gray-700 font-medium mb-1">Evidencia (archivo o foto)</label>
            <input type="file" name="evidencia" id="evidencia" class="w-full">
            @if($incidencia->evidencia)
                <p class="mt-2 text-sm text-gray-600">
                    Archivo actual: <a href="{{ asset('storage/' . $incidencia->evidencia) }}" target="_blank" class="text-indigo-600 underline hover:text-indigo-800">Ver evidencia</a>
                </p>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-md transition">
                Actualizar Incidencia
            </button>
        </div>
    </form>
</div>
@endsection
