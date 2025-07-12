@extends('layouts.app')

@section('title', 'Editar Equipo')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Equipo</h1>

        <form action="{{ route('equipos.update', $equipo->id) }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            {{-- Departamento --}}
            <div>
                <label for="departamento_id" class="block text-sm font-semibold mb-1">Dirección o Departamento</label>
                <select name="departamento_id" id="departamento_id" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700">
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}" {{ $equipo->departamento_id == $departamento->id ? 'selected' : '' }}>
                            {{ $departamento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Responsable --}}
            <div>
                <label for="empleado_id" class="block text-sm font-semibold mb-1">Responsable o Usuario Asignado</label>
                <select name="empleado_id" id="empleado_id" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700">
                    <option value="">Seleccione un empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ $equipo->empleado_id == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Marca --}}
            <div>
                <label for="marca" class="block text-sm font-semibold mb-1">Marca</label>
                <input type="text" name="marca" id="marca" value="{{ $equipo->marca }}" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
            </div>

            {{-- Modelo --}}
            <div>
                <label for="modelo" class="block text-sm font-semibold mb-1">Modelo</label>
                <input type="text" name="modelo" id="modelo" value="{{ $equipo->modelo }}" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
            </div>

            {{-- Tipo de Equipo --}}
            <div>
                <label for="tipo_equipo" class="block text-sm font-semibold mb-1">Tipo de Equipo</label>
                <select name="tipo_equipo" id="tipo_equipo" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700">
                    <option value="">Seleccione un tipo</option>
                    <option value="Laptop" {{ $equipo->tipo_equipo == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="PC de escritorio" {{ $equipo->tipo_equipo == 'PC de escritorio' ? 'selected' : '' }}>PC de escritorio</option>
                </select>
            </div>

            {{-- Memoria RAM --}}
            <div>
                <label for="memoria_ram" class="block text-sm font-semibold mb-1">Memoria RAM</label>
                <input type="text" name="memoria_ram" id="memoria_ram" value="{{ $equipo->memoria_ram }}" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
            </div>

            {{-- Disco Duro + Tipo --}}
            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Disco Duro</label>
                <div class="flex items-center gap-4">
                    <input type="text" name="disco_duro" id="disco_duro" value="{{ $equipo->disco_duro }}" required
                        class="w-[60%] rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
                    <select name="tipo_disco" id="tipo_disco" required
                        class="w-[40%] rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700">
                        <option value="">Seleccione tipo de disco</option>
                        <option value="SSD" {{ $equipo->tipo_disco == 'SSD' ? 'selected' : '' }}>SSD</option>
                        <option value="HDD" {{ $equipo->tipo_disco == 'HDD' ? 'selected' : '' }}>HDD</option>
                    </select>
                </div>
            </div>

            {{-- Procesador --}}
            <div>
                <label for="procesador" class="block text-sm font-semibold mb-1">Procesador</label>
                <input type="text" name="procesador" id="procesador" value="{{ $equipo->procesador }}" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
            </div>

            {{-- Número de Serie --}}
            <div>
                <label for="numero_serie" class="block text-sm font-semibold mb-1">Número de Serie</label>
                <input type="text" name="numero_serie" id="numero_serie" value="{{ $equipo->numero_serie }}" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
            </div>

            {{-- Fecha de Adquisición --}}
            <div>
                <label for="fecha_adquisicion" class="block text-sm font-semibold mb-1">Fecha de Adquisición</label>
                <input type="date" name="fecha_adquisicion" id="fecha_adquisicion" value="{{ $equipo->fecha_adquisicion }}" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700" />
            </div>

            {{-- Estado del Equipo --}}
            <div>
                <label for="estado" class="block text-sm font-semibold mb-1">Estado del Equipo</label>
                <select name="estado" id="estado" required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-700">
                    <option value="">Seleccione estado</option>
                    <option value="Activo" {{ $equipo->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $equipo->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="Mantenimiento" {{ $equipo->estado == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
            </div>

            {{-- Botones --}}
            <div class="col-span-2 flex justify-end gap-4 mt-4">
                <a href="{{ route('equipos.index') }}"
                    class="bg-yellow-200 text-yellow-900 px-6 py-2 rounded-2xl hover:bg-yellow-300 transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="bg-red-700 text-white px-6 py-2 rounded-2xl hover:bg-red-800 transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
