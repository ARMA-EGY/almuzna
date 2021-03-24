<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';

    protected $fillable = 
    [
        'name_en', 'name_ar', 'old_price', 'price', 'image'
    ];

}
