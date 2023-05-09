<?php
namespace App\Feature\CurrencyConversion\v1\Http\Routes;

use App\Feature\CurrencyConversion\v1\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');