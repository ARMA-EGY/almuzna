<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderItemsmodel  extends Model
{
      protected $table = 'order_items';

      protected $fillable = [
        'product_id','order_id' , 'quantity', 'total'
    ];
    
	public function Product()
	{
	    return $this->belongsTo('App\Product','product_id');
	}


}
