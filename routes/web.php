<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\PagesController@index');

Route::get('/vendor', 'App\Http\Controllers\VendorController@vendor');

Route::get('/vendor/new', 'App\Http\Controllers\VendorController@vendorNew');

Route::get('/vendor/new/{id}', array('as' => 'new', 'uses' => 'App\Http\Controllers\VendorController@vendorNew'));

Route::get('/vendor/orders', 'App\Http\Controllers\VendorController@vendorOrders');

Route::get('/vendor/edit', 'App\Http\Controllers\PagesController@vendorEdit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::put('/items', 'App\Http\Controllers\VendorController@newItem');

Route::post('/comments', 'App\Http\Controllers\ItemController@saveComment');

Route::post('/cart', 'App\Http\Controllers\UserController@addToCart');
Route::get('/cart', 'App\Http\Controllers\UserController@getCart');
Route::delete('/cart/{id}', 'App\Http\Controllers\UserController@deleteCart');

Route::get('/cabinet', 'App\Http\Controllers\UserController@cabinet');
Route::put('/cabinet', 'App\Http\Controllers\UserController@update');

Route::delete('/items/{id}', array('as' => 'delete', 'uses' => '\App\Http\Controllers\VendorController@vendorDelete'));

Auth::routes();
