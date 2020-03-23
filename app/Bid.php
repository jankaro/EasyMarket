<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function users(){
       return $this->hasOne(User::class, 'id' , 'user_id');
    }
}
