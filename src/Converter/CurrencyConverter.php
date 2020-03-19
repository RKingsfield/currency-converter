<?php

namespace App\Converter;

class CurrencyConverter
{
    protected $rates;

    public function __construct(array $rates)
    {
        $this->rates = $rates;
    }

    public function convert(string $baseCurrency, float $value, string $targetCurrency): float
    {
        if( !isset($this->rates[$baseCurrency]) ){
            throw new \InvalidArgumentException('Invalid base currency given');
        }
        if( !isset($this->rates[$baseCurrency][$targetCurrency]) ){
            throw new \Exception('No known rates for converting between these currencies');
        }

        return $this->rates[$baseCurrency][$targetCurrency] * $value;
    }
}
