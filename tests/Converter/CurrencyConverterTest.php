<?php

namespace App\Converter;

use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{

    /**
     * @dataProvider dataProviderForCurrencyConversion
     */
    public function testCurrencyConversion($input, $expectedResults)
    {
        $currencyConverter = new CurrencyConverter($input['rates']);
        foreach ($expectedResults as $targetCurrency => $expectedValue) {
            $this->assertEquals($expectedValue, $currencyConverter->convert(
                $input['baseCurrency'],
                $input['value'],
                $targetCurrency
            ));
        }
    }

    public function dataProviderForCurrencyConversion()
    {
        return [
            [
                [
                    'baseCurrency' => 'EUR',
                    'value' => 5.00,
                    'rates' => [
                        'EUR' => [
                            'GBP' => 1.2,
                            'USD' => 1.5,
                            'CAD' => 0.8
                        ]
                    ]
                ],
                [
                    'GBP' => 6.00,
                    'USD' => 7.50,
                    'CAD' => 4.00
                ]
            ]
        ];
    }

}