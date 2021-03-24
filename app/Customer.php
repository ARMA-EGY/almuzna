<?php

namespace App;
use App\Coupon;

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
}
