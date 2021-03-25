<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = 
    [
        'user_id', 'driver_id', 'status', 'step', 'payment_method', 'delivery_date', 'delivery_address', 'street_no_name', 'building_no', 'floor', 'apartment', 'notes', 'sales_tax', 'delivery_fees', 'sub_total', 'total'
    ];

}
