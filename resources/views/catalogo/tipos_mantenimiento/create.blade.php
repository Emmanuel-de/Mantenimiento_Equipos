<!-- resources/views/catalogo/tipos_mantenimiento/create.blade.php -->
@extends('layouts.app')

@section('title', 'Agregar Tipo de Mantenimiento')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Agregar Tipo de Mantenimiento</h1>

    @if ($errors->any())
        <div class="bg-red-100 p-3 rounded mb-4">
            <ul class="list-disc list-inside text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('catalogo.tipos_mantenimiento.store') }}" method="POST" class="max-w-md">
        @csrf
        <label class="block mb-2 font-semibold">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" class="border border-gray-400 rounded w-full p-2 mb-4" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
        <a href="{{ route('catalogo.tipos_mantenimiento.index') }}" class="ml-4 text-gray-700 hover:underline">Cancelar</a>
    </form>
@endsection
