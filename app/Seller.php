<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }

    public function orders(){
        return $this->hasMany(Order::class , 'seller_id');
    }
}
