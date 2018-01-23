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

Route::get('blog/{alias}', 'BlogController@show')->name('article')->where('alias', '[a-z0-9-]+');