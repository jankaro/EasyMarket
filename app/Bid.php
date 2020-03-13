<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bid extends Model
{
    public function auctions(){
        return $this->belongsTo(Auction::class , 'auction_id');
    }
}
