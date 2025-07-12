@extends('layouts.app')

@section('title', 'Lista de Mantenimientos')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Gestión de Mantenimientos</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('mantenimiento.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Registrar Mantenimiento
    </a>

    <table class="mt-6 w-full table-auto border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left border-b border-gray-300">Equipo</th>
                <th class="p-3 text-left border-b border-gray-300">Fecha</th>
                <th class="p-3 text-left border-b border-gray-300">Tipo</th>
                <th class="p-3 text-left border-b border-gray-300">Responsable</th>
                <th class="p-3 text-left border-b border-gray-300">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mantenimientos as $mantenimiento)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="p-3">{{ $mantenimiento->equipo->nombre ?? 'Equipo eliminado' }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($mantenimiento->fecha)->format('d/m/Y') }}</td>
                    <td class="p-3">{{ $mantenimiento->tipo }}</td>
                    <td class="p-3">{{ $mantenimiento->responsable }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('mantenimiento.show', $mantenimiento) }}" 
                           class="inline-block px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                            Ver
                        </a>
                        <a href="{{ route('mantenimiento.edit', $mantenimiento) }}" 
                           class="inline-block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm">
                            Editar
                        </a>
                        <form action="{{ route('mantenimiento.destroy', $mantenimiento) }}" method="POST" 
                              class="inline-block" 
                              onsubmit="return confirm('¿Eliminar este mantenimiento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">
                        No hay mantenimientos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
