<?php

namespace AutoKit\Http\ViewComposers;

use AutoKit\Components\Money\Currency;
use Illuminate\View\View;

class CurrencySymbolComposer
{
    protected $currency;

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function compose(View $view)
    {
        $view->with('currencySymbol', $this->currency->getSymbol());
    }
}