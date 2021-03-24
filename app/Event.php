<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Event extends Model
{
    protected $table = 'events';
    
    protected $fillable = [
        'user_id','title','description','class_name','start_date','end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
