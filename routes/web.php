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

/*
AUN NO TIENE LOGIN, TENGO QUE CREARLOS
*/
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

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Ruta para recuperación de contraseña (opcional)
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

//------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------
// Vista principal (dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// CRUD de Equipos
Route::resource('equipos', EquipoController::class);

// CRUD de Mantenimientos
Route::resource('mantenimiento', MantenimientoController::class);

// CRUD de Empleados
Route::resource('empleados', EmpleadoController::class);

Route::resource('departamentos', DepartamentoController::class)->only([
    'index', 'create', 'store', 'destroy'
]);

Route::resource('incidencias', IncidenciaController::class);

Route::get('/equipos/{equipo}/incidencias', [\App\Http\Controllers\EquipoController::class, 'incidencias'])->name('equipos.incidencias');

Route::get('/equipos/{equipo}/historial', [App\Http\Controllers\MantenimientoController::class, 'historial'])
    ->name('equipos.historial');

Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/reportes/exportar', [ReporteController::class, 'export'])->name('reportes.export');

Route::resource('catalogo/tipos_mantenimiento', TipoMantenimientoController::class)
    ->names('catalogo.tipos_mantenimiento');

Route::prefix('catalogo')->name('catalogo.')->group(function () {
    Route::resource('tipos_incidencias', TipoIncidenciaController::class);
});


Route::resource('fecha-mantenimientos', FechaMantenimientoController::class)->only(['index', 'create', 'store']);

Route::get('catalogo/estado-equipos', [EstadoEquipoController::class, 'index'])->name('catalogo.estados_equipos.index');