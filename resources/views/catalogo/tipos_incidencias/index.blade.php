@extends('layouts.app')

@section('title', 'Tipos de Incidencias')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Listado de Tipos de Incidencias</h1>

    <a href="{{ route('catalogo.tipos_incidencias.create') }}"
       class="mb-4 inline-block px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition">
        + Nuevo Tipo de Incidencia
    </a>

    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Descripción</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tipos as $tipo)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $tipo->nombre }}</td>
                    <td class="p-2 border">{{ $tipo->descripcion }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('catalogo.tipos_incidencias.edit', $tipo) }}" class="text-blue-500 hover:underline">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">No hay tipos de incidencias.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
