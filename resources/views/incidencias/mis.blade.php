
@extends('layouts.app')

@section('title', 'Mis Incidencias')

@section('content')
<div class="max-w-6xl mx-auto my-10 bg-white p-6 rounded-3xl shadow">
    <h1 class="text-3xl font-bold mb-6">Mis Incidencias</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('incidencias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mb-4 inline-block">
        Reportar Nueva Incidencia
    </a>

    @if($incidencias->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Equipo</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                        <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($incidencias as $incidencia)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->equipo->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->tipoIncidencia->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ Str::limit($incidencia->descripcion, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $incidencia->fecha_reporte ? $incidencia->fecha_reporte->format('d/m/Y') : 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $incidencia->estado == 'resuelto' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($incidencia->estado) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">No tienes incidencias registradas.</p>
            <a href="{{ route('incidencias.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Reportar Primera Incidencia
            </a>
        </div>
    @endif
</div>
@endsection
