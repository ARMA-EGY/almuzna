<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_location extends Model
{
    protected $table = 'customer_location';
    
    protected $fillable = [
        'customer_id', 'lat', 'lng','delivery_address', 'street', 'building','floor', 'apartment', 'note',
    ];

}
