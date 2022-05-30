<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\PagesController@index');

Route::get('/vendor', 'App\Http\Controllers\VendorController@vendor');

Route::get('/vendor/new', 'App\Http\Controllers\VendorController@vendorNew');

Route::get('/vendor/orders', 'App\Http\Controllers\PagesController@vendorOrders');

Route::get('/vendor/edit', 'App\Http\Controllers\PagesController@vendorEdit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
