<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Panel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Gradientes personalizados */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .bg-gradient-primary-dark {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
        .bg-gradient-secondary {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        }
        
        /* Efectos glassmorphism */
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-effect-dark {
            backdrop-filter: blur(20px);
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Animaciones suaves */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hover effects */
        .nav-item:hover {
            transform: translateX(4px);
        }

        /* Sombras personalizadas */
        .custom-shadow {
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
        }

        .custom-shadow-dark {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Fondo con patrón */
        .pattern-bg {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 118, 117, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(99, 179, 237, 0.2) 0%, transparent 50%);
        }
    </style>
</head>
<body x-data="{ open: true, dark: localStorage.getItem('theme') === 'true' }"
      :class="dark ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-800'"
      class="flex min-h-screen smooth-transition pattern-bg">

<!-- BARRA LATERAL DINÁMICA -->
<aside :class="open ? 'w-64' : 'w-16'" 
       class="flex flex-col bg-gradient-primary text-white smooth-transition p-4 custom-shadow relative overflow-hidden">
    
    <!-- Efecto decorativo de fondo -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white/20 to-transparent"></div>
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full"></div>
    </div>

    <!-- LOGO y BOTÓN -->
    <div class="flex items-center justify-between mb-8 relative z-10">
        <div class="flex items-center space-x-3" x-show="open" x-transition>
            <div class="bg-white rounded-full w-12 h-12 flex items-center justify-center text-2xl smooth-transition hover:scale-110">
                ⚙️
            </div>
            <div>
                <span class="font-bold text-lg">MANTENIMIENTO</span>
                <p class="text-xs text-white/80">Sistema de Gestión</p>
            </div>
        </div>
        <button @click="open = !open" 
                class="text-white text-xl p-2 rounded-lg glass-effect hover:bg-white/20 smooth-transition">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- MENÚS -->
    <nav class="flex flex-col flex-grow space-y-2 relative z-10">
        <a href="{{ route('dashboard') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('dashboard')) bg-white/25 custom-shadow @endif">
            <i class="fas fa-home text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Inicio</span>
        </a>

        <a href="{{ route('equipos.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('equipos.index')) bg-white/25 custom-shadow @endif">
            <i class="fas fa-cog text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Gestionar Equipos</span>
        </a>

        <a href="{{ route('mantenimiento.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('mantenimiento.index')) bg-white/25 custom-shadow @endif">
            <i class="fa-solid fa-hammer text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Mantenimiento</span>
        </a>

        <a href="{{ route('incidencias.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('incidencias.index')) bg-white/25 custom-shadow @endif">
            <i class="fa-solid fa-exclamation-triangle text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Historial De Incidencias</span>
        </a>

        <a href="{{ route('reportes.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('reportes.index')) bg-white/25 custom-shadow @endif">
            <i class="fa-solid fa-chart-bar text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Reportes y Consultas</span>
        </a>

        <a href="{{ route('fecha-mantenimientos.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('fe_mantenimiento.index')) bg-white/25 custom-shadow @endif">
            <i class="fa-solid fa-calendar text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Fechas de Mantenimientos</span>
        </a>

        <!-- Separador -->
        <div class="my-4" x-show="open" x-transition>
            <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
        </div>

        <!-- Catálogo -->
        <div class="mt-2 mb-3 px-3 text-xs font-bold text-white/70 uppercase tracking-wider" x-show="open" x-transition>
            <i class="fas fa-folder-open mr-2"></i>Catálogo
        </div>

        <a href="{{ route('catalogo.tipos_mantenimiento.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('catalogo.tipos_mantenimiento.*')) bg-white/25 custom-shadow @endif">
            <i class="fas fa-tools text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Tipos de Mantenimiento</span>
        </a>

        <a href="{{ route('catalogo.tipos_incidencias.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('catalogo.tipos_incidencias.*')) bg-white/25 custom-shadow @endif">
            <i class="fas fa-exclamation-triangle text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Tipos de Incidencias</span>
        </a>

        <a href="{{ route('catalogo.estados_equipos.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('catalogo.estado_equipos.index')) bg-white/25 custom-shadow @endif">
            <i class="fa-solid fa-clipboard-list text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Estado de Equipos</span>
        </a>

        <a href="{{ route('departamentos.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('departamentos.*')) bg-white/25 custom-shadow @endif">
            <i class="fas fa-building text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Áreas o Departamentos</span>
        </a>

        <a href="{{ route('empleados.index') }}" 
           class="nav-item flex items-center gap-3 py-3 px-3 rounded-xl smooth-transition glass-effect hover:bg-white/20 @if(request()->routeIs('tecnicos.*')) bg-white/25 custom-shadow @endif">
            <i class="fas fa-user-cog text-lg"></i>
            <span x-show="open" x-transition class="font-medium">Técnicos o Proveedores</span>
        </a>

        <!-- Botón de Tema (modo claro/oscuro) -->
        <div class="mt-4">
            <button @click="dark = !dark; localStorage.setItem('theme', dark)"
                class="flex items-center gap-3 glass-effect hover:bg-white/20 text-white text-sm px-3 py-3 rounded-xl w-full smooth-transition">
                <i :class="dark ? 'fas fa-sun text-yellow-300' : 'fas fa-moon text-blue-200'" class="text-lg"></i>
                <span x-show="open" x-transition class="font-medium">
                    Modo <span x-text="dark ? 'Claro' : 'Oscuro'"></span>
                </span>
            </button>
        </div>

        <div class="flex-grow"></div>

        <!-- Perfil / Logout -->
        @auth
        <div class="flex items-center gap-3 p-4 rounded-xl glass-effect bg-white/15 relative z-10">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-purple-600 font-bold text-lg custom-shadow">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="flex-1" x-show="open" x-transition>
                <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/70">{{ Auth::user()->role ?? 'Usuario' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit" 
                        class="text-white hover:text-red-300 p-2 rounded-lg glass-effect hover:bg-white/20 smooth-transition" 
                        title="Cerrar sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
        @else
        <div class="flex items-center gap-3 p-4 rounded-xl glass-effect bg-white/15">
            <div class="w-12 h-12 rounded-full bg-gray-400 flex items-center justify-center text-white">
                <i class="fas fa-user"></i>
            </div>
            <div class="flex-1" x-show="open" x-transition>
                <p class="font-semibold text-sm">Invitado</p>
                <p class="text-xs text-white/70">Sin autenticar</p>
            </div>
            <a href="{{ route('login') }}" 
               class="text-white hover:text-green-300 p-2 rounded-lg glass-effect hover:bg-white/20 smooth-transition" 
               title="Iniciar sesión">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </div>
        @endauth
    </nav>
</aside>

<!-- Contenido principal -->
<main :class="dark ? 'bg-gray-800 custom-shadow-dark' : 'bg-white custom-shadow'" 
      class="flex-1 m-4 ml-0 rounded-2xl smooth-transition backdrop-blur-sm">
    
    <!-- Header del contenido -->
    <header :class="dark ? 'bg-gray-700 border-gray-600' : 'bg-white border-gray-200'" 
            class="border-b px-8 py-6 rounded-t-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-primary bg-clip-text text-transparent">
                    @yield('page-title', 'Panel de Control')
                </h1>
                <p :class="dark ? 'text-gray-400' : 'text-gray-600'" class="text-sm mt-1">
                    @yield('page-subtitle', 'Sistema de Gestión de Mantenimiento')
                </p>
            </div>
            
            <!-- Breadcrumb o acciones adicionales -->
            <div class="flex items-center space-x-4">
                @yield('page-actions')
            </div>
        </div>
    </header>
    
    <!-- Contenido de la página -->
    <div class="p-8">
        @yield('content')
    </div>
</main>

<script>
// Mejoras adicionales de JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling para navegación
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Efecto parallax sutil para el fondo
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.pattern-bg');
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.1}px)`;
        }
    });
});
</script>

</body>
</html>