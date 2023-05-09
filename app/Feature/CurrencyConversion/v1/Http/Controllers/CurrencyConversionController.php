<?php

namespace App\Feature\CurrencyConversion\v1\Http\Controllers;

use App\Feature\CurrencyConversion\Domain\Models\Currency;
use App\Feature\CurrencyConversion\Service\Converters\FixerCurrencyConverter;
use App\Feature\CurrencyConversion\v1\Http\Requests\CurrencyConversionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;

class CurrencyConversionController extends Controller
{
    public function index() 
    {
        $currencies = Currency::all();
        return view('currency-conversion.index', compact('currencies'));
    }

    public function convert(CurrencyConversionRequest $request) {
        $converter = new FixerCurrencyConverter();
        try {
            // $response = $converter->convert($request->amount, $request->from, $request->to);
            $response = 500;
            return response()->json(['value' => $response]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
