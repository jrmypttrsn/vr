<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = [
        'published_on',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
