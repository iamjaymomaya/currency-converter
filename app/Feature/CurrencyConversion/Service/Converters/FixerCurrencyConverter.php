<?php
namespace App\Feature\CurrencyConversion\Service\Converters;

use App\Feature\CurrencyConversion\Service\CurrencyConverter;
use App\Feature\CurrencyConversion\Service\Providers\FixerCurrencyConversionProvider;

class FixerCurrencyConverter implements CurrencyConverter {
    
    public function convert(string $fromCurrencyCode, string $toCurrencyCode, float $amount = 1) {
        $provider = new FixerCurrencyConversionProvider();
        
        return $provider->convert($amount, $fromCurrencyCode, $toCurrencyCode);
    }
}