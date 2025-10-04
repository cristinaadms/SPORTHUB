<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/index', function () {
    return view('index');
})->middleware(Authenticated::class);

Route::resource('usuarios', UserController::class);
Route::resource('locais', LocalController::class);
