@extends('layouts.app')

@section('title', 'Lista de Equipos')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Gestión de Equipos</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('equipos.create') }}" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800 transition">
        Registrar Equipo
    </a>

    <table class="mt-6 w-full table-auto border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left border-b border-gray-300">Número de Serie</th>
                <th class="p-3 text-left border-b border-gray-300">Departamento</th>
                <th class="p-3 text-left border-b border-gray-300">Responsable</th>
                <th class="p-3 text-left border-b border-gray-300">Marca</th>
                <th class="p-3 text-left border-b border-gray-300">Modelo</th>
                <th class="p-3 text-left border-b border-gray-300">Tipo</th>
                <th class="p-3 text-left border-b border-gray-300">Memoria RAM</th>
                <th class="p-3 text-left border-b border-gray-300">Disco Duro</th>
                <th class="p-3 text-left border-b border-gray-300">Procesador</th>
                <th class="p-3 text-left border-b border-gray-300">Fecha de Adquisición</th>
                <th class="p-3 text-left border-b border-gray-300">Estado</th>
                <th class="p-3 text-left border-b border-gray-300">Incidencias</th>
                <th class="p-3 text-left border-b border-gray-300">Mantenimiento</th>
                <th class="p-3 text-left border-b border-gray-300">Acciones</th> <!-- NUEVA COLUMNA -->
            </tr>
        </thead>
        <tbody>
            @forelse ($equipos as $equipo)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="p-3">{{ $equipo->numero_serie }}</td>
                    <td class="p-3">{{ $equipo->departamento->nombre ?? 'Sin departamento' }}</td>
                    <td class="p-3">{{ $equipo->responsable }}</td>
                    <td class="p-3">{{ $equipo->marca }}</td>
                    <td class="p-3">{{ $equipo->modelo }}</td>
                    <td class="p-3">{{ $equipo->tipo_equipo }}</td>
                    <td class="p-3">{{ $equipo->memoria_ram }}</td>
                    <td class="p-3">{{ $equipo->disco_duro }} ({{ $equipo->tipo_disco }})</td>
                    <td class="p-3">{{ $equipo->procesador }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($equipo->fecha_adquisicion)->format('d/m/Y') }}</td>
                    <td class="p-3">{{ $equipo->estadoEquipo->nombre ?? 'Sin estado asignado' }}</td>
                    <td class="p-3">
                        <a href="{{ route('equipos.incidencias', $equipo) }}" class="text-indigo-600 hover:underline">Ver</a>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('equipos.historial', $equipo) }}" class="text-blue-600 hover:underline">Historial</a>
                    </td>
                    <td class="p-3">
                        <a href="{{ route('equipos.edit', $equipo) }}" class="text-yellow-600 hover:underline">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="14" class="p-3 text-center text-gray-500">No hay equipos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
