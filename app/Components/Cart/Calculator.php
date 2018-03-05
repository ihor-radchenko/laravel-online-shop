<?php

namespace AutoKit\Components\Cart;

use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Money;
use Illuminate\Support\Collection;

class Calculator
{
    public function totalPrice(Collection $cart, Currency $currency): Money
    {
        return $cart->reduce(function ($carry, $item) {
            return $carry->add($item->product->price->mul($item->quantity));
        }, new Money(0, $currency));
    }

    public function totalQuantity(Collection $cart): int
    {
        return $cart->sum('quantity');
    }

    public function totalWeight(Collection $cart): float
    {
        return round_up($cart->reduce(function ($carry, $item) {
            return $carry + $item->quantity * $item->product->weight;
        }), 3);
    }

    public function totalDimensions(Collection $cart): float
    {
        return round_up($cart->reduce(function ($carry, $item) {
            return $carry + $item->quantity * ($item->product->width * $item->product->height * $item->product->length);
        }), 2);
    }
}