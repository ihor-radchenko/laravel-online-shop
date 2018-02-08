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
    Route::get('brand/{brand}', 'ProductController@showByBrand')->name('products.brand');
    Route::get('{menu}', 'ProductController@index')->name('products.index');
    Route::get('{menu}/{category}', 'ProductController@showByCategory')->name('products.category');
});


Route::prefix('product')->group(function () {
    Route::get('{product}', 'ProductController@show')->name('product');
});

Route::post('review/add', 'ReviewController@store')->name('review.store');

Auth::routes();
Route::get('/confirm/{token}', 'Auth\EmailConfirmController@confirmEmail')->name('confirm');
Route::get('/home', 'HomeController@index')->name('home');