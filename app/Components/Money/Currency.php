<?php

namespace AutoKit\Components\Money;

use AutoKit\Exceptions\UnknownCurrency;

class Currency
{
    private $isoAlfa;
    private $minorUnit;
    private $isoNumber;
    private $symbol;

    /**
     * Currency constructor.
     * @param string $currency
     * @throws UnknownCurrency
     */
    public function __construct(string $currency)
    {
        $this->isoAlfa = $currency;
        $currency = $this->compile($currency);
        $this->minorUnit = $currency['minor_unit'];
        $this->isoNumber = $currency['iso_number'];
        $this->symbol = $currency['symbol'];
    }

    /**
     * @param string $currency
     * @return array
     * @throws UnknownCurrency
     */
    private function compile(string $currency): array
    {
        $currencies = require 'currencies.php';
        if ($this->notFound($currency, $currencies)) {
            throw new UnknownCurrency;
        }
        return $currencies[$currency];
    }

    public function equals(Currency $other): bool
    {
        return $this->isoNumber === $other->isoNumber;
    }

    private function notFound($key, array $search): bool
    {
        return ! array_key_exists($key, $search);
    }
}