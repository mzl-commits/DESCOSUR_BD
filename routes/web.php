<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Breeze redirige después del login a route('dashboard').
 * Nosotros lo usamos como "alias" para mandar al panel admin.
 */
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

/**
 * Rutas del panel admin (protegidas)
 */
use App\Http\Controllers\Admin\DocumentoController;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos.index');
        Route::get('/documentos/crear', [DocumentoController::class, 'create'])->name('documentos.create');
        Route::post('/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
        Route::view('/documentos/ver', 'admin.documentos.show')->name('documentos.show');
        Route::view('/proyectos', 'admin.proyectos.index')->name('proyectos.index');


    });

require __DIR__ . '/auth.php';
