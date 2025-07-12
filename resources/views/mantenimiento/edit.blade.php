@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl">
        <h1 class="text-3xl font-bold text-red-700 mb-6 text-center">Editar Mantenimiento</h1>

        <form action="{{ route('mantenimiento.update', $mantenimiento) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Equipo --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Equipo</label>
                <select     name="equipo_id" class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" required>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ $mantenimiento->equipo_id == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Fecha</label>
                <input type="date" name="fecha" value="{{ $mantenimiento->fecha }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" required />
            </div>

            {{-- Tipo --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Tipo</label>
                <select name="tipo" class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" required>
                    <option value="Preventivo" {{ $mantenimiento->tipo == 'Preventivo' ? 'selected' : '' }}>Preventivo</option>
                    <option value="Correctivo" {{ $mantenimiento->tipo == 'Correctivo' ? 'selected' : '' }}>Correctivo</option>
                </select>
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Descripción</label>
                <textarea name="descripcion" rows="3"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700">{{ $mantenimiento->descripcion }}</textarea>
            </div>

            {{-- Refacciones --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Refacciones</label>
                <textarea name="refacciones" rows="2"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700">{{ $mantenimiento->refacciones }}</textarea>
            </div>

            {{-- Responsable --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Responsable</label>
                <input type="text" name="responsable" value="{{ $mantenimiento->responsable }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" required />
            </div>

            {{-- Evidencia --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Evidencia (si deseas reemplazarla)</label>
                <input type="file" name="evidencia"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-red-700" />
                @if ($mantenimiento->evidencia)
                    <p class="mt-2 text-sm text-gray-600">
                        Archivo actual:
                        <a href="{{ asset('storage/' . $mantenimiento->evidencia) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800 transition">
                            Ver archivo
                        </a>
                    </p>
                @endif
            </div>

            {{-- Botón --}}
            <div class="text-right pt-4">
                <button type="submit"
                    class="bg-red-700 text-white px-6 py-2 rounded-2xl hover:bg-red-800 transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
