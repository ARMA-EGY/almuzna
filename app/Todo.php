<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Todo extends Model
{
    protected $table = 'todo';
    
    protected $fillable = [
        'user_id','task','done',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
