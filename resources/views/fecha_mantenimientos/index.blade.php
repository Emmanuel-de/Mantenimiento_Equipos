@extends('layouts.app')

@section('title', 'Fechas de Mantenimiento')

@section('content')
<h1 class="text-2xl font-bold mb-6">Fechas de Mantenimiento Programadas</h1>

<a href="{{ route('fecha-mantenimientos.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Agregar Fecha</a>

<table class="w-full table-auto border border-gray-300">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border">Equipo</th>
            <th class="p-2 border">Fecha Programada</th>
            <th class="p-2 border">Responsable</th>
            <th class="p-2 border">Observaciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($fechas as $fecha)
            <tr>
                <td class="p-2 border">{{ $fecha->equipo->marca }} {{ $fecha->equipo->modelo }} ({{ $fecha->equipo->numero_serie }})</td>
                <td class="p-2 border">{{ $fecha->fecha_programada }}</td>
                <td class="p-2 border">{{ $fecha->responsable }}</td>
                <td class="p-2 border">{{ $fecha->observaciones ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">No hay fechas programadas.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
