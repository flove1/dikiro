<?php


namespace App\Http\Controllers;

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

    public function vendor() {
        if (Auth::user()->role == "admin") {
            return view("vendor");
        }
        else {
            return view("index");
        }
    }

    public function vendorNew() {
        if (Auth::user()->role == "admin") {
            return view("vendorNew");
        }
        else {
            return view("index");
        }
    }
}
