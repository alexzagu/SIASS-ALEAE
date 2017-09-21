<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialService extends Model
{
    //

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'partner_id',
        'name',
        'description',
        'totalHours',
        'address',
        'managerName',
        'managerMail',
        'managerPhone',
        'capability',
        'currentCapability',
        'startDate',
        'endDate',
        'type',
        'period',
        'campus'
    ];

    public $incrementing = false;

    public function partner() {
        $this->belongsTo('App\Partner');
    }

    public $timestamps = false;
}
