<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagesController extends Controller
{
    public function index() {
        return view('index');
    }
    public function vendorOrders() {
        $title = 'Listed orders';
        return view('pages.vendorEdit', compact('title'));
    }
    public function vendorEdit() {
        $title = 'Edit game';
        return view('pages.vendorOrders', compact('title'));
    }
}
