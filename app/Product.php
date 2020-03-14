<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Product extends Model
{
    protected $fillable = ['product_title', 'price', 'description','user_id','category_id'];

    public function scopeActive($query){

        return $query->where('is_active', true);

    }

    public function scopeInactive($query){

        return $query->where('is_active', false);

    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(){
        return $this->hasOne(Category::class, 'id','category_id');
    }

    public function rates(){
        return $this->hasMany(Rate::class);
    }

    public function orders(){
        return $this->hasMany(Order::class , 'id', 'product_id');
    }

    public function auctions(){
        return $this->hasOne(Auction::class , 'product_id', 'id');
    }


}
