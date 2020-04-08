<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Auction extends Model
{
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'auction_id');

    }

    public function isDue(){
        $end_date = \Carbon\Carbon::parse($this->end_date);
        $now = Carbon::now();
        if ($now >= $end_date){
            return true;
        }else{
            return false;
        }
    }

    public function CompleteOrder(){
        $last_bid = $this->bids->sortByDesc('created_at')->first();
        if ($this->isDue() && $this->products->orders->first() == null && $last_bid != null) {
            $product = $this->products;
            $order = new Order;
            $order->product_id = $product->id;
            $order->user_id = $last_bid->users->id;
            $order->seller_id = $product->users->id;
            $order->payment_id = $last_bid->users->payments->id;
            $order->save();
            $product->is_active = false;
            $product->save();

            return true;
        }
            return false;
    }

}
