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
        'social_cause',
        'period',
        'campus'
    ];

    public $incrementing = false;

    public function partner() {
        return $this->belongsTo('App\Partner', 'partner_id', 'user_id');
    }

    public $timestamps = false;

    public function sensibilization() {
        return $this->has('App\Sensibilization');
    }

    public function comprehension() {
        return $this->has('App\Comprehension');
    }

    public function action() {
        return $this->has('App\Action');
    }

    public function transformation() {
        return $this->has('App\Transformation');
    }

    public function studentServices() {
        return $this->hasMany('App\StudentService');
    }
}
