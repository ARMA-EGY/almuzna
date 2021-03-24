<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'settings';
    
    protected $fillable = [
        'name','type','decimal_value','text_value','date_value'
    ];
}
