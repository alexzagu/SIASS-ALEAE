<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'totalRegisteredHoursSS',
        'studentStatus',
        'semester',
        'certifiedUnits',
        'campus',
        'mainPhone',
        'secondaryPhone',
        'introductionCouseStart',
        'introductionCourseEnd',
        'introductionCourseCertified',
        'recCourseStars',
        'recCourseUpload',
        'recCourseCertified',
        'isCertified',
        'certificationDate',
        'isCertificationEmailSent',
        'certificationEmailSendDate'
    ];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function studentServices() {
        return $this->hasMany('App\StudentService', 'user_id');
    }

    public $timestamps = false;
}
