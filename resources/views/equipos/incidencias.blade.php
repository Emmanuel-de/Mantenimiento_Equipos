@extends('layouts.app')

@section('title', 'Historial de Incidencias del Equipo')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-4">Historial de Incidencias: {{ $equipo->nombre }} ({{ $equipo->numero_serie }})</h1>

    @if ($incidencias->isEmpty())
        <p class="text-gray-600">No hay incidencias registradas para este equipo.</p>
    @else
        <table class="table-auto w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Fecha</th>
                    <th class="p-2 border">Descripción</th>
                    <th class="p-2 border">Reportado por</th>
                    <th class="p-2 border">Estado</th>
                    <th class="p-2 border">Técnico</th>
                    <th class="p-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incidencias as $i)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ \Carbon\Carbon::parse($i->fecha)->format('d/m/Y') }}</td>
                        <td class="p-2 border">{{ Str::limit($i->descripcion, 50) }}</td>
                        <td class="p-2 border">{{ $i->reportado_por }}</td>
                        <td class="p-2 border">{{ $i->estado }}</td>
                        <td class="p-2 border">{{ $i->tecnico ?? 'N/A' }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('incidencias.show', $i) }}" class="text-blue-600 hover:underline">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
