@extends('layouts.app')

@section('title', 'Registrar Mantenimiento')

@section('content')
<div class="max-w-4xl mx-auto my-10 bg-white p-8 rounded-2xl shadow-md">
    <h1 class="text-3xl font-bold mb-8">Registrar Mantenimiento</h1>

    @if($equipos->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
            <p>No hay equipos registrados. Por favor, <a href="{{ route('equipos.create') }}" class="underline text-blue-600">registra un equipo primero</a> antes de agregar un mantenimiento.</p>
        </div>
    @else
        <form action="{{ route('mantenimiento.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
            @csrf

            {{-- Equipo --}}
            <div>
                <label for="equipo_id" class="block mb-2 font-semibold">Equipo</label>
                <select name="equipo_id" id="equipo_id" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600">
                    <option value="">-- Seleccione un equipo --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->numero_serie }} - {{ $equipo->marca }} {{ $equipo->modelo }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha mantenimiento --}}
            <div>
                <label for="fecha" class="block mb-2 font-semibold">Fecha del mantenimiento</label>
                <input type="date" name="fecha" id="fecha" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600" />
            </div>

            {{-- Tipo mantenimiento --}}
            <div>
    <label for="tipo_mantenimiento_id" class="block mb-2 font-semibold">Tipo de mantenimiento</label>
    <select name="tipo_mantenimiento_id" id="tipo_mantenimiento_id" required
        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600">
        <option value="">-- Seleccione tipo --</option>
        @foreach(\App\Models\Catalogo\TipoMantenimiento::orderBy('nombre')->get() as $tipo)
            <option value="{{ $tipo->id }}" {{ old('tipo_mantenimiento_id') == $tipo->id ? 'selected' : '' }}>
                {{ $tipo->nombre }}
            </option>
        @endforeach
    </select>
</div>

            {{-- Responsable --}}
            <div>
                <label for="responsable" class="block mb-2 font-semibold">Responsable</label>
                <input type="text" name="responsable" id="responsable" required placeholder="Nombre del responsable"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600" />
            </div>

            {{-- Descripción --}}
            <div class="col-span-2">
                <label for="descripcion" class="block mb-2 font-semibold">Descripción del trabajo realizado</label>
                <textarea name="descripcion" id="descripcion" rows="4" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600 resize-none"></textarea>
            </div>

            {{-- Refacciones o piezas cambiadas --}}
            <div class="col-span-2">
                <label for="refacciones" class="block mb-2 font-semibold">Refacciones o piezas cambiadas (opcional)</label>
                <textarea name="refacciones" id="refacciones" rows="3" placeholder="Describe las piezas cambiadas"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600 resize-none"></textarea>
            </div>

            {{-- Evidencia --}}
            <div class="col-span-2">
                <label for="evidencia" class="block mb-2 font-semibold">Evidencia (archivo o foto, opcional)</label>
                <input type="file" name="evidencia" id="evidencia" accept="image/*,.pdf,.doc,.docx"
                    class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-600" />
            </div>

            {{-- Botones --}}
            <div class="col-span-2 flex justify-end gap-4 mt-6">
                <a href="{{ route('mantenimiento.index') }}"
                   class="px-6 py-2 rounded-xl bg-gray-200 text-gray-800 hover:bg-gray-300 transition">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-6 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                    Guardar
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
