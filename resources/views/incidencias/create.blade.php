@extends('layouts.app')

@section('title', 'Registrar Incidencia')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Registrar Nueva Incidencia</h1>

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('incidencias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Equipo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Equipo</label>
            <select name="equipo_id" class="w-full border border-gray-250 rounded-md shadow-sm">
                <option value="">Selecciona un equipo</option>
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->numero_serie }} - {{ $equipo->modelo }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Fecha</label>
            <input type="date" name="fecha" value="{{ old('fecha') }}" class="w-full border border-gray-250 rounded-md shadow-sm">
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Descripción del problema</label>
            <textarea name="descripcion" rows="4" class="w-full border border-gray-250 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
        </div>

        {{-- Reportado por --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Reportado por</label>
            <input type="text" name="reportado_por" value="{{ old('reportado_por') }}" class="w-full border border-gray-250 rounded-md shadow-sm">
        </div>

        {{-- Estado --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="estado" class="w-full border border-gray-250 rounded-md shadow-sm">
                <option value="Abierta" {{ old('estado') == 'Abierta' ? 'selected' : '' }}>Abierta</option>
                <option value="En proceso" {{ old('estado') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Cerrada" {{ old('estado') == 'Cerrada' ? 'selected' : '' }}>Cerrada</option>
            </select>
        </div>

        {{-- Solución --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Solución aplicada</label>
            <textarea name="solucion" rows="3" class="w-full border border-gray-250 rounded-md shadow-sm">{{ old('solucion') }}</textarea>
        </div>

        {{-- Técnico --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Técnico que atendió</label>
            <input type="text" name="tecnico" value="{{ old('tecnico') }}" class="w-full border border-gray-250 rounded-md shadow-sm">
        </div>

        {{-- Evidencia --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Evidencia (archivo o imagen)</label>
            <input type="file" name="evidencia" class="w-full border border-gray-250 rounded-md shadow-sm">
        </div>

        {{-- Botón --}}
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                Guardar Incidencia
            </button>
        </div>
    </form>
</div>
@endsection
