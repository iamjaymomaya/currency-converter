<?php
namespace App\Feature\CurrencyConversion\Service;

interface CurrencyConverter 
{
    public function convert(float $amount = 1, string $fromCurrencyCode, string $toCurrencyCode);
}