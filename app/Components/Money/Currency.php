<?php

namespace AutoKit\Components\Money;

use AutoKit\Exceptions\UnknownCurrency;

/**
 * Class Currency
 * @package AutoKit\Components\Money
 * @method static Currency EUR
 * @method static Currency UAH
 * @method static Currency USD
 */
class Currency
{
    public const ROOT = __DIR__ . '/currencies.php';

    /**
     * @var string
     */
    private $isoAlfa;

    /**
     * @var int
     */
    private $minorUnit;

    /**
     * @var int
     */
    private $isoNumber;

    /**
     * @var string
     */
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

    /**
     * @param $name
     * @param $arguments
     * @return Currency
     * @throws UnknownCurrency
     */
    public static function __callStatic($name, $arguments)
    {
        return new self($name);
    }

    public function getIsoAlfa(): string
    {
        return $this->isoAlfa;
    }

    public function getCountSubUnitsInUnit(): int
    {
        return pow(10, $this->minorUnit);
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public static function exist(string $currency): bool
    {
        $currencies = require 'currencies.php';
        return array_key_exists($currency, $currencies);
    }
}