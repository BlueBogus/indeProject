<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::resource('products', 'ProductController');
Route::get('products_list', 'ProductController@admin_list')->name('products_list');
Route::resource('item', 'ItemController');
Route::resource('order', 'OrderController');
Route::get('contact', 'ContactController@index')->name('contact');
