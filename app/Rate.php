<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function products(){
        return $this->belongsTo(Product::class);
    }
}
