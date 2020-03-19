<?php

namespace App\Converter;

class CurrencyConverter
{
    protected $rates;
    protected $baseCurrency;

    public function __construct(string $baseCurrency, array $rates)
    {
        $this->baseCurrency = $baseCurrency;
        $this->rates = $rates;
    }

    public function convertTo(string $targetCurrency, float $value): float
    {
        if( !isset($this->rates[$targetCurrency]) ){
            throw new \InvalidArgumentException('Invalid currency given');
        }

        return $this->rates[$targetCurrency] * $value;
    }
}
