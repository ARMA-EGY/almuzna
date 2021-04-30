<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductCategory;
use App\ProductImages;
use App\Visit;
//use digital-bird\shoppingcart\src\Contracts\Buyable;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = 
    [
        'name_en', 'name_ar', 'description_en', 'description_ar', 'on_sale', 'sale_price', 'price', 'photo', 'type', 'refill', 'refill_price'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class, 'page_token', 'token');
    }
}
