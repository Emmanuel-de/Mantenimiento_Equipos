@extends('layouts.app')

@section('title', 'Estado de Equipos')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Estados de los Equipos</h1>

    <table class="w-full table-auto border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">N° Serie</th>
                <th class="p-2 border">Marca</th>
                <th class="p-2 border">Modelo</th>
                <th class="p-2 border">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($equipos as $equipo)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $equipo->numero_serie }}</td>
                    <td class="p-2 border">{{ $equipo->marca }}</td>
                    <td class="p-2 border">{{ $equipo->modelo }}</td>
                    <td class="p-2 border">{{ $equipo->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">No hay equipos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
