@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Departamentos</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('departamentos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Crear nuevo departamento
    </a>

    @if($departamentos->isEmpty())
        <p>No hay departamentos registrados.</p>
    @else
        <table class="table-auto w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Nombre</th>
                    <th class="border border-gray-300 px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departamentos as $dep)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $dep->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $dep->nombre }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('departamentos.destroy', $dep) }}" method="POST" onsubmit="return confirm('¿Eliminar departamento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
