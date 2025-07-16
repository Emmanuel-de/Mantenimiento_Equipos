<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ open: true, dark: localStorage.getItem('theme') === 'true' }"
      :class="dark ? 'bg-gray-900 text-white' : 'bg-gray-100 text-black'"
      class="flex min-h-screen transition-colors duration-300">

<!-- BARRA LATERAL DINÁMICA -->
<aside :class="open ? 'w-64' : 'w-16'" class="flex flex-col bg-red-700 text-white transition-all duration-300 p-4">

    <!-- LOGO y BOTÓN -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-2" x-show="open" x-transition>
            <div class="bg-white rounded-full w-10 h-10 flex items-center justify-center text-red-900 font-bold text-xl">💻</div>
            <span class="font-semibold text-lg">Tecno Plus Toys</span>
        </div>
        <button @click="open = !open" class="text-white text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- MENÚS -->
    <nav class="flex flex-col flex-grow space-y-1">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('dashboard')) bg-red-800 @endif">
            <i class="fas fa-home"></i>
            <span x-show="open" x-transition>Inicio</span>
        </a>

        <a href="{{ route('equipos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('equipos.index')) bg-red-800 @endif">
            <i class="fas fa-cog"></i>
            <span x-show="open" x-transition>Gestionar Equipos</span>
        </a>

        <a href="{{ route('mantenimiento.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('mantenimiento.index')) bg-red-800 @endif">
            <i class="fa-solid fa-hammer"></i>
            <span x-show="open" x-transition>Mantenimiento</span>
        </a>

        <a href="{{ route('incidencias.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('incidencias.index')) bg-red-800 @endif">
            <i class="fa-solid fa-skull-crossbones"></i>
            <span x-show="open" x-transition>Historial De Incidencias</span>
        </a>

        <a href="{{ route('reportes.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('reportes.index')) bg-red-800 @endif">
            <i class="fa-solid fa-bug"></i>
            <span x-show="open" x-transition>Reportes y Consultas</span>
        </a>

        <a href="{{ route('fecha-mantenimientos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('fe_mantenimiento.index')) bg-red-800 @endif">
            <i class="fa-solid fa-calendar"></i>
            <span x-show="open" x-transition>Fechas de Mantenimientos</span>
        </a>

        <hr class="my-3 border-white-700" x-show="open" x-transition />

        <!-- Catálogo -->
        <div class="mt-6 mb-2 px-2 text-xs font-semibold text-white-300 uppercase tracking-wider" x-show="open" x-transition>
            Catálogo
        </div>

        <a href="{{ route('catalogo.tipos_mantenimiento.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('catalogo.tipos_mantenimiento.*')) bg-red-800 @endif">
            <i class="fas fa-tools"></i>
            <span x-show="open" x-transition>Tipos de Mantenimiento</span>
        </a>

        <a href="{{ route('catalogo.tipos_incidencias.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('catalogo.tipos_incidencias.*')) bg-red-800 @endif">
            <i class="fas fa-exclamation-triangle"></i>
            <span x-show="open" x-transition>Tipos de Incidencias</span>
        </a>

        <a href="{{ route('catalogo.estados_equipos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('catalogo.estado_equipos.index')) bg-red-800 @endif">
            <i class="fa-solid fa-clipboard-list"></i>
            <span x-show="open" x-transition>Estado de Equipos</span>
        </a>

        <a href="{{ route('departamentos.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('departamentos.*')) bg-red-800 @endif">
            <i class="fas fa-building"></i>
            <span x-show="open" x-transition>Áreas o Departamentos</span>
        </a>

        <a href="{{ route('empleados.index') }}" class="flex items-center gap-3 py-3 px-2 rounded hover:bg-red-800 @if(request()->routeIs('tecnicos.*')) bg-red-800 @endif">
            <i class="fas fa-user-cog"></i>
            <span x-show="open" x-transition>Técnicos o Proveedores</span>
        </a>

        <!-- Botón de Tema (modo claro/oscuro) -->
        <div class="mt-2">
            <button @click="dark = !dark; localStorage.setItem('theme', dark)"
                class="flex items-center gap-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-sm px-3 py-2 rounded w-full transition-all duration-300">
                <i :class="dark ? 'fas fa-sun' : 'fas fa-moon'"></i>
                <span x-show="open" x-transition>Modo <span x-text="dark ? 'Claro' : 'Oscuro'"></span></span>
            </button>
        </div>

        <div class="flex-grow"></div>

        <!-- Perfil / Logout -->
        @auth
        <div class="flex items-center gap-3 p-3 rounded bg-red-800 bg-opacity-40">
            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-red-700 font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1" x-show="open" x-transition>
                <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-red-200">{{ Auth::user()->role ?? 'Usuario' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit" class="text-white hover:text-red-300 transition-colors" title="Cerrar sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
        @else
        <div class="flex items-center gap-3 p-3 rounded bg-red-800 bg-opacity-40">
            <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-white">
                <i class="fas fa-user"></i>
            </div>
            <div class="flex-1" x-show="open" x-transition>
                <p class="font-semibold text-sm">Invitado</p>
                <p class="text-xs text-red-200">Sin autenticar</p>
            </div>
            <a href="{{ route('login') }}" class="text-white hover:text-green-300 transition-colors" title="Iniciar sesión">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </div>
        @endauth
    </nav>
</aside>

<!-- Contenido principal -->
<main :class="dark ? 'bg-gray-800' : 'bg-white'" class="flex-1 p-8 transition-colors duration-300">
    @yield('content')
</main>

</body>
</html>
