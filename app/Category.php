<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = ['name','url'];
   
    public function posts()
    {
        return $this->hasMany(Blog::class);
    }

}
