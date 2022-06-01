<?php

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('comments/{id}', '\App\Http\Controllers\ItemController@getComments');

Route::get('/vendor/new/{id}', 'App\Http\Controllers\VendorController@vendorNew');

Route::get('/items/{id}',  '\App\Http\Controllers\ItemController@getItem');

Route::get('/tags/{id}',  '\App\Http\Controllers\ItemController@getTags');

Route::get('/count',  '\App\Http\Controllers\ItemController@getItemsCount');

Route::get('/items/{from}/{count}',  '\App\Http\Controllers\ItemController@getItems');
