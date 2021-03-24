<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\ElementsModel;

class ComponentsModel extends Model
{
	  	
      protected $table = 'components';

      protected $fillable = [
        'page','section'
    ];
    
    public function ElementsModel(){
        return $this->hasMany('App\ElementsModel','component_id');
    }

}