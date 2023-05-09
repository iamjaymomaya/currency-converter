<?php
namespace App\Feature\Auth\v1\Http\Routes;

use App\Feature\Auth\v1\Http\Controllers\LoginController;
use App\Feature\Auth\v1\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'index'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::get('/login', [LoginController::class, 'index'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');