<?php

namespace AutoKit\Providers;

use AutoKit\Http\ViewComposers\CartComposer;
use AutoKit\Http\ViewComposers\NavComposer;
use AutoKit\Http\ViewComposers\SliderComposer;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.master', NavComposer::class);
        View::composer('partials.main.carousel', SliderComposer::class);
        View::composer('*', CartComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
