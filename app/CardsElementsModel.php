<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CardsElementsModel extends Model
{
	  
      protected $table = 'cardelements';

      protected $fillable = [
        'card_id','name','content','type'
    ];
    


}