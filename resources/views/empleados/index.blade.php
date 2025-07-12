@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Empleados Registrados</h1>

    <a href="{{ route('empleados.create') }}" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800">Registrar nuevo</a>

    @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-800 p-2 rounded">{{ session('success') }}</div>
    @endif

    <table class="mt-6 w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nombre</th>
                <th class="p-2">Email</th>
                <th class="p-2">Teléfono</th>
                <th class="p-2">Cargo</th>
                <th class="p-2">Departamento</th>
                <th class="p-2">Fecha Ingreso</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $empleado->nombre_completo }}</td>
                    <td class="p-2">{{ $empleado->email }}</td>
                    <td class="p-2">{{ $empleado->telefono }}</td>
                    <td class="p-2">{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->departamento->nombre }}</td>
                    <td class="p-2">{{ $empleado->fecha_ingreso }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('empleados.edit', $empleado) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" onsubmit="return confirm('¿Eliminar este empleado?');">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
