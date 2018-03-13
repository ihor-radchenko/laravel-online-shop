<?php

namespace AutoKit\Providers;

use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use Illuminate\Support\ServiceProvider;
use AutoKit\Components\Money\ExchangeRequest;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Encryption\DecryptException;

class MoneyServiceProvider extends ServiceProvider
{
    private $currency;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->currency = request()->cookie('currency', 'USD');
        if (!Currency::exist($this->currency)) {
            try {
                $this->currency = $this->app->make(Encrypter::class)->decrypt($this->currency);
            } catch (DecryptException $e) {
                $this->currency = 'USD';
            }

        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Exchanger::class, function () {
            return new Exchanger($this->app->make(ExchangeRequest::class));
        });
        $this->app->bind(Currency::class, function () {
            return new Currency($this->currency);
        });
    }
}
