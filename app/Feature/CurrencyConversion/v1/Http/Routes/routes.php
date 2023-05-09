<?php
namespace App\Feature\CurrencyConversion\v1\Http\Routes;

use App\Feature\CurrencyConversion\v1\Http\Controllers\CurrencyConversionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CurrencyConversionController::class, 'index'])->name('home.index');
Route::post('convert-currency', [CurrencyConversionController::class, 'convert'])->name('convert-currency');