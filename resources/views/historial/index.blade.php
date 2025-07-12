@extends('layouts.app')

@section('title', 'Historial de Mantenimiento')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Historial de Mantenimiento - {{ $equipo->marca }} {{ $equipo->modelo }}</h1>

    <div class="mb-4">
        <strong>Número de Serie:</strong> {{ $equipo->numero_serie }} <br>
        <strong>Estado actual:</strong> {{ $equipo->estado }}
    </div>

    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Descripción</th>
                <th class="p-2 border">Responsable</th>
                <th class="p-2 border">Tipo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mantenimientos as $mantenimiento)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $mantenimiento->fecha }}</td>
                    <td class="p-2 border">{{ $mantenimiento->descripcion }}</td>
                    <td class="p-2 border">{{ $mantenimiento->responsable ?? 'No asignado' }}</td>
                    <td class="p-2 border">{{ $mantenimiento->tipo_mantenimiento->nombre ?? 'No definido' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Sin registros de mantenimiento.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
