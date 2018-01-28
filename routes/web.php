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

Route::get('/', 'IndexController@index')->name('home');

Route::get('blog', 'BlogController@index')->name('blog');

Route::get('blog/{alias}', 'BlogController@show')->name('article');

Route::prefix('products')->group(function () {
    Route::get('brand/{alias}', 'ProductController@showByBrand')->name('products.brand');
    Route::get('{parent_category}', 'ProductController@index')->name('products.index');
    Route::get('{parent_category}/{category}', 'ProductController@showByCategory')->name('products.category');
});

Route::get('product/{id}', 'ProductController@show')->name('product');