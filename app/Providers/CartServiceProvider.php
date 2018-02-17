<?php

namespace AutoKit\Providers;

use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Cart\CartItem;
use AutoKit\Repositories\Cart\RepositoryContract;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function () {
            return new Cart($this->app->make(RepositoryContract::class));
        });
    }
}
