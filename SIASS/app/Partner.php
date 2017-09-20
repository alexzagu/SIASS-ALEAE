<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'user_id',
        'partnerName',
        'partnerAddress',
        'partnerEmail',
        'managerName',
        'managerMail',
        'managerPhone',
        'registeredBy'
    ];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function socialServices() {
        return $this->hasMany('App\SocialService');
    }
}
