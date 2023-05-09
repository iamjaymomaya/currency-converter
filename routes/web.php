<?php

use App\Feature\Auth\v1\Http\Controllers\LoginController;
use App\Feature\Auth\v1\Http\Controllers\LogoutController;
use App\Feature\Auth\v1\Http\Controllers\RegisterController;
use App\Feature\CurrencyConversion\v1\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(['middleware' => ['guest']], function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
    Route::get('/login', [LoginController::class, 'index'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.store');
});
