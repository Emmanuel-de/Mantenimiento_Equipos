<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Catalogo\TipoMantenimientoController;
use App\Http\Controllers\Catalogo\TipoIncidenciaController;
use App\Http\Controllers\Catalogo\EstadoEquipoController;
use App\Http\Controllers\FechaMantenimientoController;
use App\Http\Controllers\AuthController;

// Ruta principal - redirecciona al login si no está autenticado
Route::get('/', function () {
    return redirect('/login');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Ruta para recuperación de contraseña (opcional)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Debug route to check roles
    Route::get('/debug-roles', function () {
        $user = Auth::user();
        return [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getPermissionNames(),
            'has_admin_role' => $user->hasRole('administrador'),
            'has_tech_role' => $user->hasRole('tecnico'),
            'has_user_role' => $user->hasRole('usuario'),
        ];
    })->name('debug.roles');

    // Rutas para ADMINISTRADOR
    Route::middleware('role:administrador')->group(function () {
        // CRUD de Equipos
        Route::resource('equipos', EquipoController::class);
        
        // CRUD de Empleados
        Route::resource('empleados', EmpleadoController::class);
        
        // CRUD de Departamentos
        Route::resource('departamentos', DepartamentoController::class)->only([
            'index', 'create', 'store', 'destroy'
        ]);
        
        // Reportes completos
        Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('/reportes/exportar', [ReporteController::class, 'export'])->name('reportes.export');
        
        // Catálogos
        Route::resource('catalogo/tipos_mantenimiento', TipoMantenimientoController::class)
            ->names('catalogo.tipos_mantenimiento');
        
        Route::prefix('catalogo')->name('catalogo.')->group(function () {
            Route::resource('tipos_incidencias', TipoIncidenciaController::class);
        });
        
        Route::get('catalogo/estado-equipos', [EstadoEquipoController::class, 'index'])->name('catalogo.estados_equipos.index');
        
        Route::resource('fecha-mantenimientos', FechaMantenimientoController::class)->only(['index', 'create', 'store']);
    });

    // Rutas para TÉCNICO
    Route::middleware('role:tecnico|administrador')->group(function () {
        // CRUD de Mantenimientos
        Route::resource('mantenimiento', MantenimientoController::class);
        
        // CRUD de Incidencias (técnico puede gestionar todas)
        Route::resource('incidencias', IncidenciaController::class);
        
        // Historial de equipos
        Route::get('/equipos/{equipo}/historial', [MantenimientoController::class, 'historial'])
            ->name('equipos.historial');
    });

    // Rutas para USUARIO (y roles superiores)
    Route::middleware('role:usuario|tecnico|administrador')->group(function () {
        // Ver incidencias de equipos (solo propios para usuario común)
        Route::get('/equipos/{equipo}/incidencias', [EquipoController::class, 'incidencias'])->name('equipos.incidencias');
        
        // Crear incidencias (usuario puede reportar)
        Route::get('/incidencias/create', [IncidenciaController::class, 'create'])->name('incidencias.create');
        Route::post('/incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
        
        // Ver sus propias incidencias
        Route::get('/mis-incidencias', [IncidenciaController::class, 'misIncidencias'])->name('incidencias.mis');
        
        // Ver sus equipos
        Route::get('/mis-equipos', [EquipoController::class, 'misEquipos'])->name('equipos.mis');
    });
});

Route::get('/exportar-reporte-general-excel', [ReporteController::class, 'exportarReporteGeneralExcel'])->name('exportar.reporte.general.excel');
Route::get('/exportar-pdf', [ReporteController::class, 'exportPdf'])->name('exportar.pdf');