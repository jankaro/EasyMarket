<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    public function products(){
        return $this->belongsTo(Product::class, 'id');
    }

    public function bids(){
        return $this->hasMany(Bid::class, 'auction_id');
    }
}
