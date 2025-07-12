<!-- resources/views/catalogo/tipos_mantenimiento/index.blade.php -->
@extends('layouts.app')

@section('title', 'Tipos de Mantenimiento')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tipos de Mantenimiento</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <a href="{{ route('catalogo.tipos_mantenimiento.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        Agregar Tipo de Mantenimiento
    </a>

    <table class="w-full border border-gray-300 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Nombre</th>
                <th class="p-3 border">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tipos as $tipo)
                <tr>
                    <td class="p-3 border">{{ $tipo->id }}</td>
                    <td class="p-3 border">{{ $tipo->nombre }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('catalogo.tipos_mantenimiento.edit', $tipo) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                        <form action="{{ route('catalogo.tipos_mantenimiento.destroy', $tipo) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este tipo de mantenimiento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-3 text-center text-gray-500">No hay tipos de mantenimiento.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $tipos->links() }}
    </div>
@endsection
