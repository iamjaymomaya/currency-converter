<?php
namespace App\Feature\Auth\v1\Http\Routes;

use App\Feature\Auth\v1\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout.store');