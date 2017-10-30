<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'major',
        'studyPlan',
        'totalCertifiedHoursSSC',
        'totalRegisteredHoursSSC',
        'totalCertifiedHoursSSP',
        'totalRegisteredHoursSSP',
        'totalCertifiedHoursSS',
        'studentStatus',
        'semester',
        'certifiedUnits',
        'campus',
        'mainPhone',
        'secondaryPhone'
    ];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function studentServices() {
        return $this->hasMany('App\StudentService', 'user_id');
    }

    public $timestamps = false;
}
