@extends('layouts.app')

@section('title', 'Agregar Estado de Equipo')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Agregar Estado de Equipo</h1>

    <form action="{{ route('catalogo.estados_equipos.store') }}" method="POST" class="max-w-xl">
        @csrf

        <label for="nombre" class="block mb-2 font-semibold">Nombre del Estado</label>
        <input type="text" name="nombre" id="nombre"
               class="border border-gray-300 rounded px-4 py-2 w-full mb-4"
               placeholder="Ej: Activo" required />

        <button class="bg-red-700 text-white px-6 py-2 rounded hover:bg-red-800">
            Guardar
        </button>
    </form>
@endsection
