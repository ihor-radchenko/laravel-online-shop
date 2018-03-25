<?php

namespace AutoKit\Providers;

use AutoKit\Article;
use AutoKit\Brand;
use AutoKit\Category;
use AutoKit\Comment;
use AutoKit\Menu;
use AutoKit\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'AutoKit\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('article', '[a-z0-9-]+');
        Route::pattern('menu', '[a-z-]+');
        Route::pattern('category', '[a-z-]+');
        Route::pattern('product', '[0-9]+');
        Route::pattern('comment', '[0-9]+');
        Route::pattern('currency', '[a-z]{3}');

        Route::bind('article', function ($value) {
            return Article::whereAlias($value)->first() ?? abort(404);
        });

        Route::bind('menu', function ($value) {
            return Menu::whereAlias($value)->first() ?? abort(404);
        });

        Route::bind('category', function ($value) {
            return Category::whereAlias($value)->first() ?? abort(404);
        });

        Route::bind('token', function ($value) {
            return User::whereConfirmToken($value)->first() ?? abort(404);
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
