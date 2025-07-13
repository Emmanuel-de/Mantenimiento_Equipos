
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl mx-auto my-10 bg-white p-6 rounded-3xl shadow">
    <h1 class="text-3xl font-bold mb-6">
        Bienvenido, {{ Auth::user()->name }}
    </h1>
    
    <div class="mb-4">
        <p class="text-gray-600">
            Tu rol: <strong>{{ Auth::user()->getRoleNames()->first() ?? 'Sin rol asignado' }}</strong>
        </p>
    </div>

    <!-- Opciones rápidas basadas en roles -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        @role('administrador')
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
            <h3 class="font-bold text-blue-800 mb-2">Gestión de Equipos</h3>
            <p class="text-sm text-blue-600 mb-3">Administra todos los equipos del sistema</p>
            <a href="{{ route('equipos.index') }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                Ver Equipos
            </a>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
            <h3 class="font-bold text-green-800 mb-2">Gestión de Empleados</h3>
            <p class="text-sm text-green-600 mb-3">Administra empleados y departamentos</p>
            <a href="{{ route('empleados.index') }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                Ver Empleados
            </a>
        </div>
        
        <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
            <h3 class="font-bold text-purple-800 mb-2">Reportes</h3>
            <p class="text-sm text-purple-600 mb-3">Visualiza reportes completos</p>
            <a href="{{ route('reportes.index') }}" class="bg-purple-600 text-white px-3 py-1 rounded text-sm hover:bg-purple-700">
                Ver Reportes
            </a>
        </div>
        @endrole
        
        @role('tecnico|administrador')
        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
            <h3 class="font-bold text-yellow-800 mb-2">Mantenimientos</h3>
            <p class="text-sm text-yellow-600 mb-3">Registra y gestiona mantenimientos</p>
            <a href="{{ route('mantenimiento.index') }}" class="bg-yellow-600 text-white px-3 py-1 rounded text-sm hover:bg-yellow-700">
                Ver Mantenimientos
            </a>
        </div>
        
        <div class="bg-red-50 p-4 rounded-lg border border-red-200">
            <h3 class="font-bold text-red-800 mb-2">Gestión de Incidencias</h3>
            <p class="text-sm text-red-600 mb-3">Gestiona todas las incidencias</p>
            <a href="{{ route('incidencias.index') }}" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                Ver Incidencias
            </a>
        </div>
        @endrole
        
        @role('usuario|tecnico|administrador')
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="font-bold text-gray-800 mb-2">Mis Equipos</h3>
            <p class="text-sm text-gray-600 mb-3">Consulta tus equipos asignados</p>
            <a href="{{ route('equipos.mis') }}" class="bg-gray-600 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">
                Ver Mis Equipos
            </a>
        </div>
        
        <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
            <h3 class="font-bold text-orange-800 mb-2">Mis Incidencias</h3>
            <p class="text-sm text-orange-600 mb-3">Reporta y consulta tus incidencias</p>
            <a href="{{ route('incidencias.mis') }}" class="bg-orange-600 text-white px-3 py-1 rounded text-sm hover:bg-orange-700">
                Ver Mis Incidencias
            </a>
        </div>
        @endrole
    </div>

    <!-- Información rápida -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        @role('administrador')
        <div class="bg-gray-100 p-4 rounded text-center">
            <h4 class="font-bold">Total Equipos</h4>
            <p class="text-2xl text-blue-600">{{ \App\Models\Equipo::count() }}</p>
        </div>
        <div class="bg-gray-100 p-4 rounded text-center">
            <h4 class="font-bold">Total Empleados</h4>
            <p class="text-2xl text-green-600">{{ \App\Models\Empleado::count() }}</p>
        </div>
        @endrole
        
        @role('tecnico|administrador')
        <div class="bg-gray-100 p-4 rounded text-center">
            <h4 class="font-bold">Mantenimientos</h4>
            <p class="text-2xl text-yellow-600">{{ \App\Models\Mantenimiento::count() }}</p>
        </div>
        @endrole
        
        <div class="bg-gray-100 p-4 rounded text-center">
            <h4 class="font-bold">Incidencias</h4>
            <p class="text-2xl text-red-600">{{ \App\Models\Incidencia::count() }}</p>
        </div>
    </div>
</div>
@endsection
