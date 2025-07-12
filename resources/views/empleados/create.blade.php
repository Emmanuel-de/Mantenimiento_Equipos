@extends('layouts.app')

@section('title', 'Registrar Empleado')

@section('content')
<h1 class="text-2xl font-bold mb-6">Registrar Nuevo Empleado</h1>

<form action="{{ route('empleados.store') }}" method="POST" class="grid grid-cols-2 gap-6 max-w-4xl">
    @csrf

    <!-- Nombre Completo -->
    <div>
        <label class="block text-sm font-medium mb-1">Nombre Completo</label>
        <input type="text" name="nombre_completo" required value="{{ old('nombre_completo') }}"
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" required value="{{ old('email') }}"
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
    </div>

    <!-- Teléfono -->
    <div>
        <label class="block text-sm font-medium mb-1">Teléfono</label>
        <input type="text" name="telefono" required value="{{ old('telefono') }}"
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
    </div>

    <!-- Cargo -->
    <div>
        <label class="block text-sm font-medium mb-1">Cargo</label>
        <input type="text" name="cargo" required value="{{ old('cargo') }}"
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
    </div>

    <!-- Departamento -->
    <div>
    <label class="block text-sm font-medium mb-1">Departamento</label>
    <select name="departamento_id" required
        class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700">
        <option value="">Seleccione un departamento</option>
        @foreach ($departamentos as $departamento)
            <option value="{{ $departamento->id }}" {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                {{ $departamento->nombre }}
            </option>
        @endforeach
    </select>
</div>

    <!-- Dirección -->
    <div>
        <label class="block text-sm font-medium mb-1">Dirección</label>
        <input type="text" name="direccion" required value="{{ old('direccion') }}"
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
    </div>

    <!-- Género -->
    <div>
        <label class="block text-sm font-medium mb-1">Género</label>
        <select name="genero" required
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700">
            <option value="">Seleccionar</option>
            <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
        </select>
    </div>

    <!-- Fecha de Ingreso -->
    <div>
        <label class="block text-sm font-medium mb-1">Fecha de Ingreso</label>
        <input type="date" name="fecha_ingreso" required value="{{ old('fecha_ingreso') }}"
            class="w-full rounded border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
    </div>

    <!-- Botones -->
    <div class="col-span-2 flex justify-end gap-4 mt-4">
        <a href="{{ route('empleados.index') }}"
            class="bg-yellow-200 text-yellow-900 px-6 py-2 rounded hover:bg-yellow-300 transition">Cancelar</a>
        <button type="submit"
            class="bg-red-700 text-white px-6 py-2 rounded hover:bg-red-800 transition">Guardar</button>
    </div>
</form>
@endsection
