<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
           if ( !$post->author_id ) {
               $post->author_id = Auth::id();
            }
        });
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
