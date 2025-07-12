@extends('layouts.app')

@section('title', 'Detalle de Incidencia')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-3xl shadow my-10">
    <h1 class="text-2xl font-bold mb-6">Detalle de Incidencia</h1>

    <ul class="space-y-2">
        <li><strong>Equipo:</strong> {{ $incidencia->equipo->numero_serie ?? 'Equipo eliminado' }}</li>
        <li><strong>Fecha:</strong> {{ $incidencia->fecha }}</li>
        <li><strong>Descripción:</strong> {{ $incidencia->descripcion }}</li>
        <li><strong>Reportado por:</strong> {{ $incidencia->reportado_por }}</li>
        <li><strong>Estado:</strong> {{ $incidencia->estado }}</li>
        <li><strong>Solución:</strong> {{ $incidencia->solucion ?? 'N/A' }}</li>
        <li><strong>Técnico:</strong> {{ $incidencia->tecnico ?? 'N/A' }}</li>
        <li><strong>Evidencia:</strong>
            @if ($incidencia->evidencia)
                <a href="{{ asset('storage/' . $incidencia->evidencia) }}" class="text-blue-600 underline" target="_blank">Ver archivo</a>
            @else
                No disponible
            @endif
        </li>
    </ul>

    <div class="mt-6">
        <a href="{{ route('incidencias.index') }}" class="bg-gray-200 px-4 py-2 rounded-xl">Volver</a>
    </div>
</div>
@endsection
