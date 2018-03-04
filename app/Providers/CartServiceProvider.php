<?php

namespace AutoKit\Providers;

use AutoKit\Components\Cart\Cart;
use AutoKit\Components\Cart\CartItemCreator;
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
        $this->app->singleton('Cart', Cart::class);
        $this->app->singleton(Cart::class, Cart::class);
    }
}
