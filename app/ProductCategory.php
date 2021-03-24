<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    
    protected $fillable = ['name','url'];
   
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


}
