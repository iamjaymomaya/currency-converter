<?php

namespace App\Feature\CurrencyConversion\v1\Http\Controllers;

use App\Http\Controllers\Controller;

class CurrencyConversionController extends Controller
{
    public function index() 
    {
        return view('currency-conversion.index');
    }
}
