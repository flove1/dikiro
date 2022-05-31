<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ItemController extends Controller
{
    public function getItem($id) {
        return response(json_encode(Item::find($id)), 200);
    }
    public function getItems(Request $request, $from, $count) {
        if ($request->tags != '[]') {
            $tags = json_decode($request->tags);
            $tagsQuery = Tag::all();
            foreach ($tags as $tag) {
                $tagsQuery = $tagsQuery->where('tag', '=', $tag);
            }
            $items = new \Illuminate\Database\Eloquent\Collection();
            foreach ($tagsQuery as $tag) {
                $items->add($tag->item);
            }
            return response(json_encode($items->unique()->skip($from)->take($count)), 200);
        }
        else {
            return response(json_encode(Item::all()->skip($from)->take($count)), 200);
        }
    }
    public function getTags($id) {
        return response(json_encode(Item::find($id)->tags), 200);
    }
}
