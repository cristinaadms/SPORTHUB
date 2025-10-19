<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authenticated;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rotas exclusivas para administradores -- Provavelmente vamos tirar
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/index', [LocalController::class, 'adminIndex'])->name('admin.index');
    Route::resource('usuarios', UserController::class);
    Route::resource('local', LocalController::class)->except(['index', 'show']);
});

// Rotas para usuários logados (qualquer papel)
Route::middleware(Authenticated::class)->group(function () {
    Route::get('/', [PartidaController::class, 'index'])->name('index');
    Route::get('/minhas-partidas', [PartidaController::class, 'index'])->name('minhas-partidas');
    Route::get('/perfil', [UserController::class, 'show'])->name('perfil');
    Route::resource('local', LocalController::class)->only(['index', 'show']);
    Route::resource('partidas', PartidaController::class);
});
