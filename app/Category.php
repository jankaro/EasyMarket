<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products(){
        return $this->belongsTo(Product::class , 'category_id' );
    }
}
