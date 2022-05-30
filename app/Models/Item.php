<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public static function store(Request $request): string {;
        if (Auth::check()) {
            if(!$request->hasFile('image')) {
                return response()->json(['upload_file_not_found'], 400);
            }
            $file = $request->file('image');
            if(!$file->isValid()) {
                return response()->json(['invalid_file_upload'], 400);
            }
            $path = public_path() . '/img/';

            $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");
            $nextId = $statement[0]->Auto_increment;

            $file->move($path, $nextId.".".$file->getClientOriginalExtension());

            $item = new Item;
            $item->name = $request->name;
            $item->price = $request->price;
            $item->count = $request->count;
            $item->desc = $request->desc;;
            $item->img_path = $nextId.".".$file->getClientOriginalExtension();

            $item->save();

            return response()->json();
        }
        return view('index')->render();
    }
}
