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

    public function total_sales(){
        $total_sales = 0;
        foreach ($this->where('status', '=', 'confirmed')->get() as $order){
            if ($order->products->is_auction){
                $total_sales += $order->products->auctions->current_price;
            } else {
                $total_sales += $order->products->price;
            }


        }
        return $total_sales;
    }

    public function total_sales_chart($orders){
        $total_sales = 0;
        foreach ($orders->where('status', '=', 'confirmed') as $order){
            if ($order->products->is_auction){
                $total_sales += $order->products->auctions->current_price;
            } else {
                $total_sales += $order->products->price;
            }


        }
        return $total_sales;
    }
}
