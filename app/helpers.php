<?php

if (! function_exists('round_up')) {
    function round_up ($value, $places = 0) {
        $places = $places < 0 ? 0 : $places;
        $mult = pow(10, $places);
        return ceil($value * $mult) / $mult;
    }
}