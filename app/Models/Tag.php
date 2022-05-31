<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;
    private mixed $item_id;
    public function item() {
        return $this->belongsTo( 'App\Models\Item');
    }
}
