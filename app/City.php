<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = 
    [
        'name_en', 'name_ar', 'area_en', 'area_ar', 'delivery_fees', 'available', 
    ];

}