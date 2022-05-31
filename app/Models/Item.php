<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'count',
        'desc',
        'img_path'];

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function tags() {
        return $this->hasMany('App\Models\Tag');
    }

    public static function store(Request $request) {
//        if(!$file->isValid()) {
//            return response()->json(['invalid_file_upload'], 400);
//        }
        $path = public_path() . '/img/';

        $statement = DB::select("SHOW TABLE STATUS LIKE 'items'");
        if ($request->has('id')) {
            $item = Item::find($request->id);
            $id = $request->id;
        }
        else {
            $item = new Item;
            $id = $statement[0]->Auto_increment;
        }

        $item->name = $request->name;
        $item->price = $request->price;
        $item->count = $request->count;
        $item->desc = $request->desc;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move($path, $id.".".$file->getClientOriginalExtension());
            $item->img_path = 'img/'.$id.'.'.$file->getClientOriginalExtension();
        }

        $item->save();
        $existing_tags_objects = Tag::where('item_id', '=', $id)->get();
        $existing_tags = [];
        foreach ($existing_tags_objects as $tag) {
            $existing_tags[] = $tag->tag;
        }
        foreach (array_diff($existing_tags, json_decode($request->tags)) as $dif) {
            $existing_tags_objects->slice(array_search($dif, $existing_tags), 1)->first()->delete();
        }
        foreach (array_diff(json_decode($request->tags), $existing_tags) as $dif) {
            Log::info(json_encode($existing_tags));
            $tag = new Tag;
            $tag->tag = $dif;
            $tag->item_id = $item->id;
            $tag->save();
        }
    }
}
