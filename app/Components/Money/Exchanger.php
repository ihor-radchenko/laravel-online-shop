<?php

namespace AutoKit\Components\Money;

use Illuminate\Support\Collection;

class Exchanger
{
    /**
     * @var ExchangeRequest
     */
    private $client;

    /**
     * @var Currency
     */
    private $baseCurrency;

    /**
     * @var Collection
     */
    private $exchanges;

    /**
     * Exchanger constructor.
     * @param ExchangeRequest $exchangeRequest
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function __construct(ExchangeRequest $exchangeRequest)
    {
        $this->client = $exchangeRequest;
        $this->baseCurrency = new Currency(config('money.base_currency'));
        $this->exchanges = $this->compile();
    }

    public function convert(Money $money, Currency $toCurrency): Money
    {
        $fromCurrency = $money->getCurrency();
        if ($this->isSameCurrency($fromCurrency, $toCurrency)) {
            return $money;
        }
        $ratio = $this->getRatio($this->getRate($fromCurrency), $this->getRate($toCurrency));
        return $money->mul($ratio, $toCurrency);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function compile(): Collection
    {
        return $this->client->getCurrencyRates();
    }

    private function isSameCurrency(Currency $currency, Currency $toCurrency): bool
    {
        return $currency->equals($toCurrency);
    }

    private function getRate(Currency $currency): float
    {
        if ($this->isBaseCurrency($currency)) {
            return 1;
        }
        return $this->exchanges
            ->where('cc', $currency->getIsoAlfa())
            ->first()
            ->rate;
    }

    private function isBaseCurrency(Currency $currency): bool
    {
        return $this->baseCurrency->equals($currency);
    }

    private function getRatio(float $fromRate, float $toRate): float
    {
        return bcdiv($fromRate, $toRate, 6);
    }
}