<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'registeredBy',
        'defaultPasswordChanged'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function socialServices() {
        return $this->hasMany('App\SocialService', 'partner_id');
    }

    public $timestamps = false;
}
