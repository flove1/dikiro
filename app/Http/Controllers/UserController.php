<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request) {
        $item = new CartItem();
        $item->user_id = Auth::id();
        $item->item_id = $request->id;
        $item->count = $request->count;
        $item->save();
    }

    public function getCart() {
        $cart = Auth::user()->cart;
        $items = [];
        foreach ($cart as $item) {
            $items[] = [
                'id' => $item->id,
                'count' => $item->count,
                'item' => $item->item,
            ];
        }
        return response(json_encode($items), 200);
    }

    public function cabinet() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();
        $hasher = app('hash');
        if ($hasher->check($request->password, $user->password)) {
            $user->name = $request->username;
            if($request->hasFile('image')) {
                $path = public_path() . '/img/pfp/';
                $file = $request->file('image');
                $file->move($path, $user->id.".".$file->getClientOriginalExtension());
                $user->img_path = 'img/pfp/'.$user->id.'.'.$file->getClientOriginalExtension();
            }
            if ($request->has('new_password') && $request->has('new_password_repeat') && strlen($request->new_password)>=8 && $request->new_password == $request->new_password_repeat) {
                $user->password = Hash::make($request->new_password);
            }
            $user->save();
        }
        return redirect('/');
    }

    public function deleteCart($id) {
        Auth::user()->cart->where('id', '=', $id)->first()->delete();
    }
}
