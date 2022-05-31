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

Route::get('comments/{id}', function ($id) {
    $comments = Item::find($id)->comments;
    $object = [];
    foreach ($comments as $comment) {
        $object[] = [
            'id' => $comment->customer_id,
            'name' => User::find($comment->customer_id)->name,
            'date' => $comment->date,
            'comment' => $comment->comment
        ];
    }
    return $object;
});

Route::get('/vendor/new/{id}', array('as' => 'group', 'uses' => 'App\Http\Controllers\VendorController@vendorNew'));
