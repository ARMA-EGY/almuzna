<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\CardsElementsModel;

class CardsModel extends Model
{

      protected $table = 'cards';

      protected $fillable = [
        'name'
    ];
    
    public function CardsElementsModel(){
        return $this->hasMany('App\CardsElementsModel','card_id');
    }

}