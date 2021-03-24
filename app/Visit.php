<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Page;
use App\Blog;
use App\Product;

class Visit extends Model
{
    protected $table = 'visits';
    
    protected $fillable = [
        'ip','page_token','views'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'token', 'page_token');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'token', 'page_token');
    }

    public function product()
    {
        return $this->belongsTo(Page::class, 'token', 'page_token');
    }
}
