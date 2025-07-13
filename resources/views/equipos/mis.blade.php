
@extends('layouts.app')

@section('title', 'Mis Equipos')

@section('content')
<div class="max-w-6xl mx-auto my-10 bg-white p-6 rounded-3xl shadow">
    <h1 class="text-3xl font-bold mb-6">Mis Equipos</h1>

    @if($equipos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($equipos as $equipo)
                <div class="bg-gray-50 p-4 rounded-lg border">
                    <h3 class="font-bold text-lg mb-2">{{ $equipo->nombre }}</h3>
                    <p class="text-gray-600 mb-1"><strong>Marca:</strong> {{ $equipo->marca }}</p>
                    <p class="text-gray-600 mb-1"><strong>Modelo:</strong> {{ $equipo->modelo }}</p>
                    <p class="text-gray-600 mb-1"><strong>Departamento:</strong> {{ $equipo->departamento->nombre ?? 'N/A' }}</p>
                    <p class="text-gray-600 mb-3"><strong>Estado:</strong> 
                        <span class="px-2 py-1 text-xs rounded-full {{ $equipo->estado == 'operativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($equipo->estado) }}
                        </span>
                    </p>
                    <div class="flex space-x-2">
                        <a href="{{ route('equipos.incidencias', $equipo) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                            Ver Incidencias
                        </a>
                        @role('tecnico|administrador')
                        <a href="{{ route('equipos.historial', $equipo) }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                            Historial
                        </a>
                        @endrole
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500">No tienes equipos asignados.</p>
        </div>
    @endif
</div>
@endsection