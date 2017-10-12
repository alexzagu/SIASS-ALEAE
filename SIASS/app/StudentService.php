<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentService extends Model
{
    //

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'service_id',
        'studentName',
        'certifiedHours',
        'status',
        'dischargeLetter'
    ];

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function socialService() {
        return $this->belongsTo('App\SocialService');
    }
}