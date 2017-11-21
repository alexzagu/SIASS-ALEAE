<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DischargeLetter extends Model
{
    protected $fillable = [
        'student_service_id',
        'file_name',
        'link',
        'MIME',
        'uploaded_at'
    ];

    public function student_services() {
        return $this->belongsTo('App\StudentService');
    }

    public $timestamps = false;

    protected $primaryKey = 'student_service_id';

    protected $keyType = 'string';
}
