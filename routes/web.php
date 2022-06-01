<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\PagesController@index')->name('index');

Route::get('/vendor', 'App\Http\Controllers\VendorController@vendor')->name('vendor');
Route::get('/vendor/new', 'App\Http\Controllers\VendorController@vendorNew')->name('newItem');
Route::get('/vendor/new/{id}', array('as' => 'new', 'uses' => 'App\Http\Controllers\VendorController@vendorNew'))->name('newItemId');
Route::get('/vendor/orders', 'App\Http\Controllers\VendorController@vendorOrders')->name('orders');
Route::delete('/items/{id}', array('as' => 'delete', 'uses' => '\App\Http\Controllers\VendorController@vendorDelete'));
Route::put('/items', 'App\Http\Controllers\VendorController@newItem');

Route::get('/cart', 'App\Http\Controllers\UserController@getCart')->name('getCart');
Route::post('/cart', 'App\Http\Controllers\UserController@addToCart')->name('addToCart');
Route::delete('/cart/{id}', 'App\Http\Controllers\UserController@deleteCart');

Route::put('/cabinet', 'App\Http\Controllers\UserController@update')->name('userUpdate');
Route::get('/cabinet', 'App\Http\Controllers\UserController@cabinet');

Route::post('/comments', 'App\Http\Controllers\ItemController@saveComment')->name('saveComment');

Auth::routes();
