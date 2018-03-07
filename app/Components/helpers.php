<?php

use AutoKit\Components\Money\Money;

if (! function_exists('round_up')) {

    /**
     * @param float|null $value
     * @param int $places
     * @return float
     */
    function round_up (?float $value, int $places = 0): float
    {
        $places = $places < 0 ? 0 : $places;
        $mult = pow(10, $places);
        return ceil($value * $mult) / $mult;
    }
}