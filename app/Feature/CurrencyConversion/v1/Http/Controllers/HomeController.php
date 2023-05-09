<?php

namespace App\Feature\CurrencyConversion\v1\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() 
    {
        return view('welcome');
    }
}
