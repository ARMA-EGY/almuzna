<?php

namespace App;
use App\Coupon;
use App\Order;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = 
    [
        'name', 'phone', 'gender', 'email', 
    ];

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function Order(){
        return $this->hasMany('App\Order','user_id');
    }     
}
