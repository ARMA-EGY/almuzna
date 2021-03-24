<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductImages extends Model
{
    protected $table = 'product_images';
    
    protected $fillable = [
        'product_id', 'image', 'alt', 'selected',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
