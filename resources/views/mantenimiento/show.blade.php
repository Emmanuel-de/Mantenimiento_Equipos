@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl">
        <h1 class="text-3xl font-bold text-red-700 mb-6 text-center">Detalle del Mantenimiento</h1>

        <div class="grid grid-cols-1 gap-4 text-gray-800 text-lg">
            <div>
                <span class="font-semibold">Equipo:</span>
                {{ $mantenimiento->equipo->nombre ?? 'Equipo eliminado' }}
            </div>

            <div>
                <span class="font-semibold">Fecha:</span>
                {{ $mantenimiento->fecha }}
            </div>

            <div>
                <span class="font-semibold">Tipo:</span>
                {{ $mantenimiento->tipo }}
            </div>

            <div>
                <span class="font-semibold">Descripción:</span>
                <p class="mt-1 text-base text-gray-600">{{ $mantenimiento->descripcion }}</p>
            </div>

            <div>
                <span class="font-semibold">Refacciones:</span>
                {{ $mantenimiento->refacciones ?? 'N/A' }}
            </div>

            <div>
                <span class="font-semibold">Responsable:</span>
                {{ $mantenimiento->responsable }}
            </div>

            @if ($mantenimiento->evidencia)
                <div>
                    <span class="font-semibold">Evidencia:</span>
                    <a href="{{ asset('storage/' . $mantenimiento->evidencia) }}" target="_blank"
                        class="text-blue-600 underline hover:text-blue-800 transition">
                        Ver archivo
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-8 text-right">
            <a href="{{ route('mantenimiento.index') }}"
                class="bg-red-700 text-white px-6 py-2 rounded-2xl hover:bg-red-800 transition">
                Volver
            </a>
        </div>
    </div>
</div>
@endsection
