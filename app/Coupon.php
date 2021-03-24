<?php

namespace App;
use App\Customer;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = 
    [
        'code', 'start_date', 'end_date', 'use_num',  'discount', 'available', 'type',  'used',  'private', 
    ];


    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function hasCustomer($customerID)
    {
        $customers = $this->customers->pluck('id')->toArray();
        return in_array($customerID, $customers);
    }
}
