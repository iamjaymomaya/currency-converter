<?php
namespace App\Feature\CurrencyConversion\Service;

interface CurrencyConverter 
{
    public function convert(string $fromCurrencyCode, string $toCurrencyCode, float $amount = 1);
}