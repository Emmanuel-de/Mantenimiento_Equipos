@extends('layouts.app')

@section('title', 'Editar Estado')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Editar Estado</h1>

    <form action="{{ route('catalogo.estados_equipos.update', $estado) }}" method="POST" class="max-w-xl">
        @csrf @method('PUT')

        <label for="nombre" class="block mb-2 font-semibold">Nombre del Estado</label>
        <input type="text" name="nombre" id="nombre" value="{{ $estado->nombre }}"
               class="border border-gray-300 rounded px-4 py-2 w-full mb-4"
               required />

        <button class="bg-red-700 text-white px-6 py-2 rounded hover:bg-red-800">
            Actualizar
        </button>
    </form>
@endsection
