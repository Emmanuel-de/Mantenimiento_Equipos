@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Crear departamento</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departamentos.store') }}" method="POST" class="max-w-md">
        @csrf

        <label for="nombre" class="block mb-1 font-semibold">Nombre del departamento</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
            class="border border-gray-300 rounded px-3 py-2 w-full mb-4" required>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('departamentos.index') }}" class="ml-4 text-gray-700 underline">Cancelar</a>
    </form>
@endsection
