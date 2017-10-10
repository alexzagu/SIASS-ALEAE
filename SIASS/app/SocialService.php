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

    public function sensibilization() {
        $this->has('App\Sensibilization');
    }

    public function comprehension() {
        $this->has('App\Comprehension');
    }

    public function action() {
        $this->has('App\Action');
    }

    public function transformation() {
        $this->has('App\Transformation');
    }
}
