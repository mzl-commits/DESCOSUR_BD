<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DocumentoController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\Usuario\DocumentoController as UsuarioDocumentoController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Breeze redirige después del login a route('dashboard').
 * Lo usamos como alias hacia el panel admin.
 */
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = auth()->user();

    if (!$user->estado) {
        auth()->logout();
        return redirect('/login')->with('error', 'Usuario deshabilitado.');
    }

    return match ($user->rol) {
        'ADMIN' => redirect()->route('admin.dashboard'),
        'ENCARGADO', 'LECTOR' => redirect()->route('panel.dashboard'),
        default => abort(403),
    };
    
})->name('dashboard');

/**
 * Rutas del panel admin (protegidas)
 */
Route::middleware(['auth', 'rol:ADMIN'])
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

/**
 * Rutas del panel operativo (ENCARGADO y LECTOR)
 */



Route::middleware(['auth', 'rol:ENCARGADO,LECTOR'])
    ->prefix('panel')
    ->name('usuario.')
    ->group(function () {

        // Dashboard
        Route::view('/dashboard', 'usuario.dashboard')->name('dashboard');

        // Lista de documentos
        Route::get('/documentos', [UsuarioDocumentoController::class, 'index'])
            ->name('documentos.index');

        // Formulario para subir documento
        Route::get('/documentos/crear', [UsuarioDocumentoController::class, 'create'])
            ->name('documentos.create'); // ✅ corregido

        // Solo ENCARGADO puede almacenar/actualizar documentos
        Route::middleware('rol:ENCARGADO')->group(function () {
            Route::post('/documentos', [UsuarioDocumentoController::class, 'store'])
                ->name('documentos.store');
            Route::put('/documentos/{id}', [UsuarioDocumentoController::class, 'update'])
                ->name('documentos.update');
        });

        // Otros módulos
        Route::view('/proyectos', 'usuario.proyectos.index')->name('proyectos.index');
        Route::get('/clasificaciones', [ClassificationController::class, 'index'])->name('classifications.index');
});



require __DIR__ . '/auth.php';
