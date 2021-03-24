<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponCustomer extends Model
{
    protected $table = 'coupon_customer';
    
    protected $fillable = [
        'customer_id', 'coupon_id', 'used',
    ];

}
