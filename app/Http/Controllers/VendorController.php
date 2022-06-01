<?php


namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\File;
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
            return redirect('/');
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
            return redirect('/');
        }
    }

    public function vendorOrders() {
        if (Auth::user()->role == "admin") {
            return view('vendorOrders');
        }
        else {
            return redirect('/');
        }
    }

    public function newItem(Request $request) {
        if (Auth::user()->role == 'admin') {
            Item::store($request);
            return redirect('/vendor');
        }
        return redirect('/');
    }

    public static function vendorDelete($id)
    {
        if (Auth::check()) {
            File::delete(Item::find($id)->img_path);
            Item::find($id)->delete();
            return response('succ', 200);
        }
        else {
            return response('notsucc', 500);
        }
    }
}
