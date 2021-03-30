<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstOrderDiscount extends Model
{
    protected $table = 'first_order_discount';
    
    protected $fillable = [
        'type','value','off'
    ];
}