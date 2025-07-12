@extends('layouts.app')

@section('title', 'Agregar Fecha de Mantenimiento')

@section('content')
<div class="max-w-4xl mx-auto my-10 bg-white p-8 rounded-2xl shadow-md">
    <h1 class="text-3xl font-bold mb-8">Agregar Fecha de Mantenimiento</h1>

    <form action="{{ route('fecha-mantenimientos.store') }}" method="POST" class="grid grid-cols-1 gap-6">
        @csrf

        <div>
            <label for="equipo_id" class="block mb-2 font-semibold">Equipo</label>
            <select name="equipo_id" id="equipo_id" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600">
                <option value="">-- Seleccione un equipo --</option>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}">{{ $equipo->marca }} {{ $equipo->modelo }} ({{ $equipo->numero_serie }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fecha_programada" class="block mb-2 font-semibold">Fecha Programada</label>
            <input type="date" name="fecha_programada" id="fecha_programada" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600" />
        </div>

        <div>
            <label for="responsable" class="block mb-2 font-semibold">Responsable</label>
            <input type="text" name="responsable" id="responsable" placeholder="Nombre del responsable" required
                class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600" />
        </div>

        <div>
            <label for="observaciones" class="block mb-2 font-semibold">Observaciones (opcional)</label>
            <textarea name="observaciones" id="observaciones" rows="3"
                class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600 resize-none"></textarea>
        </div>

        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('fecha-mantenimientos.index') }}"
               class="px-6 py-2 rounded-xl bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                Cancelar
            </a>
            <button type="submit"
                class="px-6 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
