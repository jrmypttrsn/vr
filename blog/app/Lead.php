<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    const ORGANIC_TYPE = 'Organic';
    const USER_SUBMITTED_TYPE = 'User Submitted';

    const PROSPECT_STATUS = 'Prospect';
    const LEAD_STATUS = 'Lead';
    const CUSTOMER_STATUS = 'Customer';

    protected $fillable = [
        'type',
        'status',
        'first_name',
        'last_name',
        'full_name',
        'email',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($lead) {
            $lead->full_name = $lead->first_name . ' ' . $lead->last_name;
        });
    }

    public static function getTypes()
    {
        return [
            self::ORGANIC_TYPE => self::ORGANIC_TYPE,
            self::USER_SUBMITTED_TYPE => self::USER_SUBMITTED_TYPE,
        ];
    }

    public static function getStatuses()
    {
        return [
            self::PROSPECT_STATUS => self::PROSPECT_STATUS,
            self::LEAD_STATUS => self::LEAD_STATUS,
            self::CUSTOMER_STATUS => self::CUSTOMER_STATUS,
        ];
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
