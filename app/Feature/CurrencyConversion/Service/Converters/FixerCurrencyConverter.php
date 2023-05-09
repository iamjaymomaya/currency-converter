<?php
namespace App\Feature\CurrencyConversion\Service\Converters;

use App\Feature\CurrencyConversion\Service\CurrencyConverter;
use App\Feature\CurrencyConversion\Service\Providers\FixerCurrencyConversionProvider;

class FixerCurrencyConverter implements CurrencyConverter {
    
    public function convert(float $amount = 1, string $fromCurrencyCode, string $toCurrencyCode) {
        $provider = new FixerCurrencyConversionProvider();
        
        return $provider->convert($amount, $fromCurrencyCode, $toCurrencyCode);
    }
}