<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')
    ->name('main');

Route::get('blog', 'BlogController@index')
    ->name('blog');

Route::get('blog/{article}', 'BlogController@show')
    ->name('article');

Route::prefix('products')->group(function () {
    Route::get('{menu}', 'ProductController@index')
        ->name('products.index');

    Route::get('{menu}/{category}', 'ProductController@showByCategory')
        ->name('products.category');
});


Route::prefix('product')->group(function () {
    Route::get('{product}', 'ProductController@show')
        ->name('product');
});

Auth::routes();

Route::middleware('ajax')->group(function () {
    Route::get('check/email', 'Auth\RegisterController@checkEmail')
        ->name('check.email');

    Route::post('review', 'ReviewController@store')
        ->name('review.store');

    Route::post('comment', 'CommentController@store')
        ->name('comment.store');

    Route::prefix('cart')->group(function () {
        Route::get('add', 'CartController@incrementOrDecrementItem')
            ->name('cart.add');

        Route::get('remove', 'CartController@remove')
            ->name('cart.remove');
    });

    Route::prefix('order')->group(function () {
        Route::get('delivery', 'Order\DeliveryController@delivery')
            ->name('delivery.delivery');

        Route::get('self-delivery', 'OrderController@selfDelivery')
            ->name('order.selfDelivery');

        Route::get('region', 'Order\DeliveryController@region')
            ->name('delivery.region');

        Route::get('city', 'Order\DeliveryController@city')
            ->name('delivery.city');

        Route::get('warehouse', 'Order\DeliveryController@warehouse')
            ->name('delivery.warehouse');

        Route::get('category', 'Order\DeliveryController@category')
            ->name('delivery.category');

        Route::post('delivery/calculation', 'Order\DeliveryController@calculation')
            ->name('delivery.calculation');
    });

    Route::get('home/orders/info', 'HomeController@order')
        ->name('order.info');

    Route::get('search/list', 'SearchController@search')
        ->name('search.list');

    Route::delete('comments/{comment}', 'CommentController@delete')
        ->name('comment.delete');

    Route::put('comments/{comment}', 'CommentController@update')
        ->name('comment.update');
});

Route::get('/confirm/{token}', 'Auth\EmailConfirmController@confirmEmail')
    ->name('confirm');

Route::prefix('home')->group(function () {
    Route::get('/', 'HomeController@index')
        ->name('home');

    Route::post('user/update', 'HomeController@update')
        ->name('user.update');

    Route::get('change-password', 'Auth\ChangePasswordController@index')
        ->name('change.password');

    Route::post('user/change-password', 'Auth\ChangePasswordController@update')
        ->name('user.update.pass');

    Route::get('orders', 'HomeController@orders')
        ->name('home.orders');
});

Route::get('cart', 'CartController@index')
    ->name('cart');

Route::get('order', 'OrderController@index')
    ->name('order')->middleware('order');

Route::get('change/currency/{currency}', 'IndexController@changeCurrency')
    ->name('currency.change')
    ->middleware('currency');

Route::post('payment/order', 'OrderController@store')
    ->name('payment')
    ->middleware('stripe');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'IndexController@index')
        ->name('admin.main');
});

Route::get('search', 'SearchController@index')
    ->name('search.index');