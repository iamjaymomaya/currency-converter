<?php

namespace App\Feature\CurrencyConversion\v1\Http\Controllers;

use App\Feature\CurrencyConversion\Domain\Models\Currency;
use App\Feature\CurrencyConversion\Service\Converters\FixerCurrencyConverter;
use App\Feature\CurrencyConversion\v1\Http\Requests\CurrencyConversionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
            $user = Auth::user();
            
            $userQuery = $user->persistConversionQuery($request->amount, $request->from, $request->to);
            $key = $request->getCacheKeyTitle();
            $response = Cache::remember($key, 60, function () use($converter, $request) {
                return $converter->convert($request->amount, $request->from, $request->to);
            });
            
            $user->updateResponse($userQuery, $response);

            return response()->json(['value' => $response]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function currencyConversionLogs() {
        return Auth::user()->userCurrencyConversionLogsInDesc;
    }
}
