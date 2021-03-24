<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Visit;

class Page extends Model
{
    protected $table = 'pages';
    
    protected $fillable = [
        'name','token',
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'page_token', 'token');
    }
}
