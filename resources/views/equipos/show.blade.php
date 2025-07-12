@extends('layouts.app')

@section('title', 'Detalle del Equipo')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detalles del Equipo</h1>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <strong>Número de Serie:</strong>
            <p>{{ $equipo->numero_serie }}</p>
        </div>

        <div>
            <strong>Marca:</strong>
            <p>{{ $equipo->marca }}</p>
        </div>

        <div>
            <strong>Modelo:</strong>
            <p>{{ $equipo->modelo }}</p>
        </div>

        <div>
            <strong>Tipo de Equipo:</strong>
            <p>{{ $equipo->tipo_equipo }}</p>
        </div>

        <div>
            <strong>Procesador:</strong>
            <p>{{ $equipo->procesador }}</p>
        </div>

        <div>
            <strong>Memoria RAM:</strong>
            <p>{{ $equipo->memoria_ram }}</p>
        </div>

        <div>
            <strong>Disco Duro:</strong>
            <p>{{ $equipo->disco_duro }} ({{ $equipo->tipo_disco }})</p>
        </div>

        <div>
            <strong>Responsable:</strong>
            <p>{{ $equipo->responsable }}</p>
        </div>

        <div>
            <strong>Departamento:</strong>
            <p>{{ $equipo->departamento->nombre ?? 'Sin asignar' }}</p>
        </div>

        <div>
            <strong>Fecha de Adquisición:</strong>
            <p>{{ \Carbon\Carbon::parse($equipo->fecha_adquisicion)->format('d/m/Y') }}</p>
        </div>

        <div>
            <strong>Estado:</strong>
            <p>{{ $equipo->estado }}</p>
        </div>
    </div>

    <a href="{{ route('equipos.historial', $equipo) }}"
        class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Ver Historial de Mantenimiento
    </a>
@endsection
