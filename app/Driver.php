<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $fillable = 
    [
        'name', 'phone', 'gender', 'email',  'image', 'fcm_token' , 'fcm_lang'
    ];

    public function Order(){
        return $this->hasMany('App\Order','driver_id');
    }     

}