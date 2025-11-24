<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\NewPasswordResetController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authenticated;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [NewPasswordResetController::class, 'reset'])->name('password.update');

// Rotas exclusivas para administradores -- Provavelmente vamos tirar
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/index', [LocalController::class, 'adminIndex'])->name('admin.index');
    Route::resource('usuarios', UserController::class);
    Route::resource('local', LocalController::class)->except(['index', 'show']);
});

// Rotas para usuários logados (qualquer papel)
Route::middleware(Authenticated::class)->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/', [PartidaController::class, 'index'])->name('index');
    Route::get('/minhas-partidas', [PartidaController::class, 'minhasPartidas'])->name('minhas-partidas');
    Route::get('/perfil', [UserController::class, 'show'])->name('perfil');
    Route::get('/perfil/editar', [UserController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [UserController::class, 'update'])->name('perfil.update');
    Route::resource('local', LocalController::class)->only(['index', 'show']);
    Route::resource('partidas', PartidaController::class);
    Route::get('/partidas/{partida}/chat', [PartidaController::class, 'chat'])->name('partidas.chat');
    Route::get('/partidas/{partida}/chat/messages', [ChatMessageController::class, 'index'])->name('partidas.chat.messages.index');
    Route::post('/partidas/{partida}/chat/messages', [ChatMessageController::class, 'store'])->name('partidas.chat.messages.store');
    // rotas de interação com as partidas
    Route::post('/partidas/{partida}/entrar', [PartidaController::class, 'entrar'])->name('partidas.entrar');
    Route::post('/partidas/{partida}/aceitar/{user}', [PartidaController::class, 'aceitar'])->name('partidas.aceitar');
    Route::post('/partidas/{partida}/recusar/{user}', [PartidaController::class, 'recusar'])->name('partidas.recusar');

    // GERENCIAR PARTICIPANTES
    Route::post('/partidas/{partida}/expulsar/{user}', [PartidaController::class, 'expulsar'])->name('partidas.expulsar');

    Route::post('/partidas/{partida}/sair', [PartidaController::class, 'sair'])->name('partidas.sair');
    Route::post('/partidas/{partida}/cancelar', [PartidaController::class, 'cancelarSolicitacao'])->name('partidas.cancelar');
    // Avaliações
    Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
});
