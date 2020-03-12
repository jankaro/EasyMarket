<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsTo(Product::class ,'product_id');
    }

    public function sellers(){
        return $this->belongsTo(Seller::class , 'id');
    }
}
