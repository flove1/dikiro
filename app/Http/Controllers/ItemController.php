<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Item;
use App\Models\Tag;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function getItem($id) {
        return response(json_encode(Item::find($id)), 200);
    }
    public function getItems(Request $request, $from, $count) {
        if ($request->tags != '[]') {
            $tags = json_decode($request->tags);
            $items = new \Illuminate\Database\Eloquent\Collection();
            foreach (Item::all() as $item) {
                $keep = true;
                foreach ($tags as $tag) {
                    if (!$item->tags->contains('tag', $tag)) {
                        $keep = false;
                    }
                }
                if ($keep) {
                    $items->add($item);
                }
            }
            return response(json_encode($items->unique()->skip($from)->take($count)), 200);
        }
        else {
            return response(json_encode(Item::all()->skip($from)->take($count)), 200);
        }
    }
    public function getItemsCount(Request $request) {
        if ($request->tags != '[]' && $request->tags!=null) {
            $tags = json_decode($request->tags);
            $items = new \Illuminate\Database\Eloquent\Collection();
            foreach (Item::all() as $item) {
                $keep = true;
                foreach ($tags as $tag) {
                    if (!$item->tags->contains('tag', $tag)) {
                        $keep = false;
                    }
                }
                if ($keep) {
                    $items->add($item);
                }
            }
            return response($items->count(), 200);
        }
        else {
            return response(Item::all()->count(), 200);
        }
    }
    public function getComments($id) {
        $comments = Item::find($id)->comments;
        $object = [];
        foreach ($comments as $comment) {
            $object[] = [
                'id' => $comment->customer_id,
                'name' => User::find($comment->customer_id)->name,
                'img_path' => User::find($comment->customer_id)->img_path,
                'date' => $comment->date,
                'comment' => $comment->comment
            ];
        }
        return $object;
    }

    public function saveComment(Request $request) {
        $comment = new Comment;
        $comment->customer_id = Auth::user()->id;
        $comment->item_id = $request->id;
        $comment->comment = $request->comment;
        $comment->date = Carbon::now()->format('Y-m-d');
        $comment->save();
        return redirect('/');

    }
    public function getTags($id) {
        return response(json_encode(Item::find($id)->tags), 200);
    }
}
