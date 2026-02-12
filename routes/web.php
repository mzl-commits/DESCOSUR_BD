<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DocumentoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Breeze redirige después del login a route('dashboard').
 * Lo usamos como alias hacia el panel admin.
 */
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

/**
 * Rutas del panel admin (protegidas)
 */
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        // Documentos
        Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');
        Route::get('/documentos/crear', [DocumentoController::class, 'create'])->name('documentos.create');
        Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');

        // Si aún no tienes show en controlador, lo dejamos como vista
        Route::view('/documentos/ver', 'admin.documentos.show')->name('documentos.show');

        // Proyectos / Sectores / UBIGEO
        Route::view('/proyectos', 'admin.proyectos.index')->name('proyectos.index');
        Route::view('/sectores', 'admin.sectores.index')->name('sectores.index');
        Route::view('/ubigeo', 'admin.ubigeo.index')->name('ubigeo.index');

        // Configuración (Types & Tags)
        Route::view('/clasificaciones', 'admin.classifications.index')->name('classifications.index');

        // Auditoría (Audit Log)
        Route::view('/audit', 'admin.audit.index')->name('audit.index');

        // Usuarios (User & Role Management)
        // OJO: NO pongas "/admin/users" aquí adentro porque ya hay prefix('admin')
        Route::view('/users', 'admin.users.index')->name('users.index');
        // Si prefieres ruta en español:
        // Route::view('/usuarios', 'admin.users.index')->name('users.index');
    });

require __DIR__ . '/auth.php';
