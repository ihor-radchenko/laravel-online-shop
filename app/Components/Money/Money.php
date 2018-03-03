<?php

namespace AutoKit\Components\Money;

use AutoKit\Exceptions\DifferentCurrencies;
use AutoKit\Exceptions\ImpossibleSubtracts;

/**
 * Class Money
 * @package AutoKit\Components\Money
 * @method static Money EUR(int $amount)
 * @method static Money USD(int $amount)
 * @method static Money UAH(int $amount)
 */
class Money
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function equals(Money $other): bool
    {
        return $this->equalsCurrency($other) && $this->compareTo($other) === 0;
    }

    public function greaterThan(Money $other): bool
    {
        return $this->equalsCurrency($other) && $this->compareTo($other) === 1;
    }

    public function lessThan(Money $other): bool
    {
        return $this->equalsCurrency($other) && $this->compareTo($other) === -1;
    }

    public function greaterThanOrEquals(Money $other): bool
    {
        return $this->equalsCurrency($other) && $this->compareTo($other) >= 0;
    }

    public function lessThanOrEquals(Money $other): bool
    {
        return $this->equalsCurrency($other) && $this->compareTo($other) <= 0;
    }

    /**
     * @param Money $other
     * @return Money
     * @throws DifferentCurrencies
     */
    public function add(Money $other): self
    {
        if (! $this->equalsCurrency($other)) {
            throw new DifferentCurrencies;
        }
        return new self($this->amount + $other->amount, $this->currency);
    }

    /**
     * @param Money $other
     * @return Money
     * @throws DifferentCurrencies
     * @throws ImpossibleSubtracts
     */
    public function sub(Money $other): self
    {
        if (! $this->equalsCurrency($other)) {
            throw new DifferentCurrencies;
        }
        if ($this->lessThan($other)) {
            throw new ImpossibleSubtracts;
        }
        return new self($this->amount - $other->amount, $this->currency);
    }

    public function mul($multiplier, ?Currency $currency = null): self
    {
        $newAmount = bcmul($this->amount, $multiplier);
        return new self($newAmount, $currency ?? $this->currency);
    }

    public function div($divider, ?Currency $currency = null): self
    {
        $newAmount = bcdiv($this->amount, $divider);
        return new self($newAmount, $currency ?? $this->currency);
    }

    private function compareTo(Money $other): int
    {
        return $this->amount <=> $other->amount;
    }

    private function equalsCurrency(Money $other): bool
    {
        return $this->currency->equals($other->currency);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Money
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public static function __callStatic($name, $arguments)
    {
        return new self($arguments[0], new Currency($name));
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}