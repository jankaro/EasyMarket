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
        return $this->hasMany(Rate::class , 'product_id' , 'id');
    }

    public function orders(){
        return $this->hasMany(Order::class , 'id', 'product_id');
    }

    public function auctions(){
        return $this->hasOne(Auction::class , 'product_id', 'id');
    }

    public function carts(){
        return $this->hasMany(Cart::class , 'product_id', 'id');
    }

    public function rate($product_id){
        $rates= Product::find($product_id)->rates;
        $rates_sum=0;
        $rates_count=0;
        $avg_rate=0;
        foreach ($rates as $rate){
            $rates_sum += $rate->rate_value;
            $rates_count++;
        }
        if ($rates_sum == 0 ){
            return 0;
        }else {
            $avg_rate = $rates_sum / $rates_count;
            return round($avg_rate, 1);
        }

    }


}
