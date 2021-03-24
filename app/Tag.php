<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class Tag extends Model
{
    
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Blog::class);
    }

}
