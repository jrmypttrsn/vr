<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Lead extends Model
{
    use Actionable;

    protected $casts = [
        'is_winner' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
