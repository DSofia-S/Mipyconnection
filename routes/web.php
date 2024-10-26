<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');


Route::post('/login', [LoginController::class, 'login'])->name('login.submit');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:administrador'])->group(function () {
        Route::get('/admin', [AdminController::class, 'Empresas'])->name('admin.Empresas');
        Route::get('/adminGestion/{id}', [AdminController::class, 'Gestion'])->name('admin.Gestion');
        Route::post('/empresa/aprobar/{id}', [EmpresaController::class, 'aprobar'])->name('empresa.aprobar');
        Route::post('/empresa/rechazar/{id}', [EmpresaController::class, 'rechazar'])->name('empresa.rechazar');
    });
    Route::middleware(['role:Empresas'])->group(function () {
        Route::get('/empresa/inicio', [EmpresaController::class, 'Inicioempresas'])->name('empresa.Inicioempresas');

    });
});

Route::prefix('/registro-empresa')->name('empresa.')->group(function () {
    // Paso 1: Formulario inicial
    Route::get('/paso-1', [EmpresaController::class, 'paso1'])->name('paso1');
    Route::post('/paso-1', [EmpresaController::class, 'guardarPaso1'])->name('guardarPaso1');

    Route::get('/paso-2', [EmpresaController::class, 'paso2'])->name('paso2');
    Route::post('/paso-2', [EmpresaController::class, 'guardarPaso2'])->name('guardarPaso2');

    Route::get('/paso-3', [EmpresaController::class, 'paso3'])->name('paso3');
    Route::post('/paso-3', [EmpresaController::class, 'guardarPaso3'])->name('guardarPaso3');
});

Route::get('/exitoorechazo', function () {
    return view('empresa.exitoorechazo');
})->name('exitoorechazo');
