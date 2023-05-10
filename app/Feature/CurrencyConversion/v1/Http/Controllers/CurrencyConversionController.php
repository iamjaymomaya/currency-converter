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
    const REMEMBER_USER_QUERY_CACHE_TIME_IN_SECONDS = 60;

    const REMEMBER_USER_QUERY_LOGS = 600;

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
            $queryLogkey = $this->getUserLogsCacheKeyTitle();
            Cache::forget($queryLogkey);
            $response = Cache::remember($key, self::REMEMBER_USER_QUERY_CACHE_TIME_IN_SECONDS, function () use($converter, $request) {
                return $converter->convert($request->amount, $request->from, $request->to);
            });
            
            $user->updateResponse($userQuery, $response);

            return response()->json(['value' => $response]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function currencyConversionLogs() {
        $key = $this->getUserLogsCacheKeyTitle();
        $logs = Cache::remember($key, self::REMEMBER_USER_QUERY_LOGS, function () {
            return Auth::user()->userCurrencyConversionLogsInDesc;
        });
        return $logs;
    }

    protected function getUserLogsCacheKeyTitle()
    {
        return "users_logs_" . Auth::user()->id;
    }
}
