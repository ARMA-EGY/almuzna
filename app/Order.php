<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderItemsmodel;
use App\Customer;
use App\Driver;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = 
    [
        'user_id', 'driver_id', 'status', 'step', 'payment_method', 'delivery_date', 'delivery_address', 'street_no_name', 'building_no', 'floor', 'apartment', 'notes', 'sales_tax', 'delivery_fees', 'sub_total', 'total'
    ];

    public function OrderItemsmodel(){
        return $this->hasMany('App\OrderItemsmodel','order_id');
    }    

    public function Customer(){
        return $this->belongsTo('App\Customer','user_id');
    }  

    public function Driver(){
        return $this->belongsTo('App\Driver','driver_id');
    }    

}
