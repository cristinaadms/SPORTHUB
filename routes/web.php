<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authenticated;
use Illuminate\Support\Facades\Route;

// Página inicial padrão do laravel
Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Rotas para usuários logados (qualquer papel)
Route::middleware(Authenticated::class)->group(function () {
    Route::get('/index', [PartidaController::class, 'index'])->name('index');
    Route::get('/minhas-partidas', [PartidaController::class, 'index'])->name('minhas-partidas');
    Route::get('/perfil', [UserController::class, 'show'])->name('perfil');
    Route::resource('partidas', PartidaController::class);
});

// Rotas exclusivas para administradores
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::resource('usuarios', UserController::class);
    Route::resource('locais', LocalController::class);
});
