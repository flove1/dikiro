<?php


namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function vendor() {
        if (Auth::user()->role == "admin") {
            return view("vendor");
        }
        else {
            return view("index");
        }
    }

    public static function vendorNew($id = null) {
        if (Auth::user()->role == "admin") {
            if ($id != null) {
                $item = Item::find($id);
                return view("vendorNew", compact("item"));
            }
            else {
                return view("vendorNew");
            }
            }
        else {
            return view("index");
        }
    }

    public function newItem(Request $request) {
        Item::store($request);
        return view('vendor');
    }

    public static function vendorDelete($id)
    {
        if (Auth::check()) {
            Item::find($id)->delete();
            return response('succ', 200);
        }
        else {
            return response('notsucc', 500);
        }
    }
}
