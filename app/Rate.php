<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function products(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function users(){
        return $this->hasOne(User::class, 'id','user_id');
    }
}
