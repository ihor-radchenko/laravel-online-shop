<?php

namespace AutoKit\Providers;

use AutoKit\Repositories\Cart\RepositoryContract;
use AutoKit\Repositories\Cart\SessionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(RepositoryContract::class, function () {
            if (config('shopping_cart.driver') === 'session') {
                return new SessionRepository;
            }
            return null;
        });
    }
}
