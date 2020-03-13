<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auction extends Model
{
    public function products(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function bids(){
        return $this->hasMany(Bid::class , 'id' , 'auction_id');
    }
}
