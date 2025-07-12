@extends('layouts.app')

@section('title', 'Incidencias Registradas')

@section('content')
<div class="max-w-6xl mx-auto my-10 bg-white p-6 rounded-3xl shadow">
    <h1 class="text-3xl font-bold mb-6">Lista de Incidencias</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('incidencias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Registrar Nueva Incidencia
    </a>

    <table class="mt-6 w-full table-auto border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border-b text-left">Fecha</th>
                <th class="p-3 border-b text-left">Equipo</th>
                <th class="p-3 border-b text-left">Descripción</th>
                <th class="p-3 border-b text-left">Estado</th>
                <th class="p-3 border-b text-left">Técnico</th>
                <th class="p-3 border-b text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incidencias as $incidencia)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="p-3">{{ \Carbon\Carbon::parse($incidencia->fecha)->format('d/m/Y') }}</td>
                    <td class="p-3">{{ $incidencia->equipo->numero_serie ?? 'Equipo eliminado' }}</td>
                    <td class="p-3">{{ Str::limit($incidencia->descripcion, 40) }}</td>
                    <td class="p-3">{{ $incidencia->estado }}</td>
                    <td class="p-3">{{ $incidencia->tecnico ?? 'N/A' }}</td>
                    <td class="p-3 space-x-2">
                        

                        <a href="{{ route('incidencias.show', $incidencia) }}" 
                           class="inline-block px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                            Ver
                        </a>

                        <a href="{{ route('incidencias.edit', $incidencia) }}" class="inline-block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm">Editar</a>
                        <form action="{{ route('incidencias.destroy', $incidencia) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta incidencia?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm"> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-3 text-center text-gray-500">No hay incidencias registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
