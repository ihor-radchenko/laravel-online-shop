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

Route::get('/', 'IndexController@index')->name('main');

Route::get('blog', 'BlogController@index')->name('blog');

Route::get('blog/{article}', 'BlogController@show')->name('article');

Route::prefix('products')->group(function () {
    Route::get('{menu}', 'ProductController@index')->name('products.index');
    Route::get('{menu}/{category}', 'ProductController@showByCategory')->name('products.category');
});


Route::prefix('product')->group(function () {
    Route::get('{product}', 'ProductController@show')->name('product');
});

Auth::routes();

Route::middleware('ajax')->group(function () {
    Route::get('check/email', 'Auth\RegisterController@checkEmail')->name('check.email');

    Route::post('review', 'ReviewController@store')->name('review.store');
    Route::post('comment', 'CommentController@store')->name('comment.store');

    Route::prefix('cart')->group(function () {
        Route::get('add', 'CartController@incrementOrDecrementItem')->name('cart.add');
        Route::get('remove', 'CartController@remove')->name('cart.remove');
    });

    Route::prefix('order')->group(function () {
        Route::get('delivery', 'Order\DeliveryController@delivery')->name('delivery.delivery');
        Route::get('self-delivery', 'OrderController@selfDelivery')->name('order.selfDelivery');
        Route::get('region', 'Order\DeliveryController@region')->name('delivery.region');
        Route::get('city', 'Order\DeliveryController@city')->name('delivery.city');
        Route::get('warehouse', 'Order\DeliveryController@warehouse')->name('delivery.warehouse');
        Route::get('category', 'Order\DeliveryController@category')->name('delivery.category');
    });
});

Route::get('/confirm/{token}', 'Auth\EmailConfirmController@confirmEmail')->name('confirm');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('cart', 'CartController@index')->name('cart');

Route::get('order', 'OrderController@index')->name('order')->middleware('order');