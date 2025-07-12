<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

<!-- BARRA ALADO -->
    <aside class="flex flex-col bg-sky-700 text-white w-64 p-4">

        <!-- LOGO -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-2">
                <div class="bg-white rounded-full w-10 h-10 flex items-center justify-center text-red-900 font-bold text-xl">★</div>
                <span class="font-semibold text-lg">Mantenimiento de Equipos</span>
            </div>
            <button class="text-white text-2xl md:hidden">
                <i class="fas fa-bars"></i>
            </button>
        </div>

<!-- MENUS -->
        <nav class="flex flex-col flex-grow">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('dashboard')) bg-sky-800 @endif">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>

            <a href="{{ route('equipos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('equipos.index')) bg-sky-800 @endif">
                <i class="fas fa-cog"></i>
                <span>Gestionar Equipos</span>
            </a>

            <a href="{{ route('mantenimiento.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('mantenimiento.index')) bg-sky-800 @endif">
                <i class="fa-solid fa-hammer"></i>
                <span>Mantenimiento</span>
            </a>

            {{-- <a href="{{ route('equipos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('historial_mantenimiento.index')) bg-sky-800 @endif">
                <i class="fa-solid fa-file-waveform"></i>
                <span>Historial De Mantenimientos</span>
            </a> --}}

            <a href="{{ route('incidencias.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('incidencias.index')) bg-sky-800 @endif">
                <i class="fa-solid fa-skull-crossbones"></i>
                <span>Historial De Incidencias</span>
            </a>

            <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('reportes.index')) bg-sky-800 @endif">
                <i class="fa-solid fa-bug"></i>
                <span>Reportes y Consultas</span>
            </a>

            <a href="{{ route('fecha-mantenimientos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('fe_mantenimiento.index')) bg-sky-800 @endif">
                <i class="fa-solid fa-calendar"></i>
                <span>Fechas de Mantenimientos</span>
            </a>

            <hr class="my-3 border-white-700" />

<!-- Nuevo apartado Catálogo -->
            <div class="mt-6 mb-2 px-2 text-xs font-semibold text-white-300 uppercase tracking-wider">
                Catálogo
            </div>

            <a href="{{ route('catalogo.tipos_mantenimiento.index') }}" 
               class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800
               @if(request()->routeIs('catalogo.tipos_mantenimiento.*')) bg-sky-800 @endif">
                <i class="fas fa-tools"></i>
                <span>Tipos de Mantenimiento</span>
            </a>

            <a href="{{ route('catalogo.tipos_incidencias.index') }}" 
               class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800
               @if(request()->routeIs('catalogo.tipos_incidencias.*')) bg-sky-800 @endif">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Tipos de Incidencias</span>
            </a>

            <a href="{{ route('catalogo.estados_equipos.index') }}"
   class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800 @if(request()->routeIs('catalogo.estado_equipos.index')) bg-sky-800 @endif">
   <i class="fa-solid fa-clipboard-list"></i>
   <span>Estado de Equipos</span>
</a>

            <a href="{{ route('departamentos.index') }}" 
               class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800
               @if(request()->routeIs('departamentos.*')) bg-sky-800 @endif">
                <i class="fas fa-building"></i>
                <span>Áreas o Departamentos</span>
            </a>

            <a href="{{ route('empleados.index') }}" 
               class="flex items-center gap-3 py-3 px-2 rounded hover:bg-sky-800
               @if(request()->routeIs('tecnicos.*')) bg-sky-800 @endif">
                <i class="fas fa-user-cog"></i>
                <span>Técnicos o Proveedores</span>
            </a>

            <div class="flex-grow"></div>

<!-- Perfil y Logout -->
            @auth
            <div class="flex items-center gap-3 p-3 rounded bg-sky-800 bg-opacity-40">
                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-sky-700 font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-sky-200">
                        {{ Auth::user()->role ?? 'Usuario' }}
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                    @csrf
                    <button type="submit" class="text-white hover:text-red-300 transition-colors" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 rounded bg-sky-800 bg-opacity-40">
                <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-white">
                    <i class="fas fa-user"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm">Invitado</p>
                    <p class="text-xs text-sky-200">Sin autenticar</p>
                </div>
                <a href="{{ route('login') }}" class="text-white hover:text-green-300 transition-colors" title="Iniciar sesión">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
            </div>
            @endauth
        </nav>
    </aside>

<!-- Contenido principal -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>
</html>
