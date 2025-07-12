@extends('layouts.app')

@section('title', 'Reportes y Consultas')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Módulo de Reportes y Consultas</h1>

    {{-- Formulario de filtros --}}
    <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div>
            <label class="block text-sm font-medium">Departamento / Área</label>
            <select name="departamento_id" class="w-full border border-gray-300 rounded p-2">
                <option value="">Todos</option>
                @foreach($departamentos as $d)
                    <option value="{{ $d->id }}" {{ request('departamento_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Tipo de Mantenimiento</label>
            <select name="tipo_mantenimiento" class="w-full border border-gray-300 rounded p-2">
                <option value="">Todos</option>
                <option value="Preventivo" {{ request('tipo_mantenimiento') == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                <option value="Correctivo" {{ request('tipo_mantenimiento') == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Estado de Incidencia</label>
            <select name="estado_incidencia" class="w-full border border-gray-300 rounded p-2">
                <option value="">Todos</option>
                <option value="Abierta" {{ request('estado_incidencia') == 'Abierta' ? 'selected' : '' }}>Abierta</option>
                <option value="En proceso" {{ request('estado_incidencia') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Cerrada" {{ request('estado_incidencia') == 'Cerrada' ? 'selected' : '' }}>Cerrada</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Periodo</label>
            <select name="periodo" class="w-full border border-gray-300 rounded p-2">
                <option value="">Todos</option>
                <option value="semanal" {{ request('periodo') == 'semanal' ? 'selected' : '' }}>Última semana</option>
                <option value="mensual" {{ request('periodo') == 'mensual' ? 'selected' : '' }}>Este mes</option>
                <option value="anual" {{ request('periodo') == 'anual' ? 'selected' : '' }}>Este año</option>
            </select>
        </div>

        <div class="col-span-1 md:col-span-2 lg:col-span-4">
            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Aplicar filtros
            </button>
        </div>
    </form>

    {{-- Tabla de Mantenimientos --}}
    <h2 class="text-xl font-semibold mt-6 mb-2">Mantenimientos</h2>
    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-300 rounded-lg mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Equipo</th>
                    <th class="p-2 border">Tipo</th>
                    <th class="p-2 border">Fecha</th>
                    <th class="p-2 border">Responsable</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mantenimientos as $m)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $m->equipo->nombre ?? 'Sin información del equipo' }}</td>
                        <td class="p-2 border">{{ $m->tipo }}</td>
                        <td class="p-2 border">{{ \Carbon\Carbon::parse($m->fecha)->format('d/m/Y') }}</td>
                        <td class="p-2 border">{{ $m->responsable }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-2 text-center text-gray-500">No hay resultados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tabla de Incidencias --}}
    <h2 class="text-xl font-semibold mt-6 mb-2">Incidencias</h2>
    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-300 rounded-lg mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Equipo</th>
                    <th class="p-2 border">Estado</th>
                    <th class="p-2 border">Fecha</th>
                    <th class="p-2 border">Reportado por</th>
                </tr>
            </thead>
            <tbody>
                @forelse($incidencias as $i)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $i->equipo->nombre ?? 'Sin información del equipo' }}</td>
                        <td class="p-2 border">{{ $i->estado }}</td>
                        <td class="p-2 border">{{ \Carbon\Carbon::parse($i->fecha)->format('d/m/Y') }}</td>
                        <td class="p-2 border">{{ $i->reportado_por }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-2 text-center text-gray-500">No hay resultados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Botones de exportación --}}
    <div class="flex gap-4">
        <form method="GET" action="{{ route('reportes.export') }}">
            <input type="hidden" name="format" value="excel">
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Exportar a Excel
            </button>
        </form>

        <form method="GET" action="{{ route('reportes.export') }}">
            <input type="hidden" name="format" value="pdf">
            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                Exportar a PDF
            </button>
        </form>
    </div>
</div>
@endsection
