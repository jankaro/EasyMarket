<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

public function products(){
    return $this->hasMany(Product::class, 'user_id' , 'id');
}

public function orders(){
    return $this->hasMany(Order::class);
}

public function payments(){
    return $this->hasOne(Payment::class);
}

public function sellers(){
    return $this->hasOne(Seller::class , 'user_id', 'id');
}

    public function carts(){
        return $this->hasMany(Cart::class , 'user_id', 'id');
    }

    public function admins(){
        return $this->hasOne(Admin::class, 'user_id' , 'id');
    }

}
