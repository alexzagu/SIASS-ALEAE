<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensibilization extends Model
{
    protected $fillable = [
    'social_service_id',
    'ethical_recognition',
    'empathy',
    'moral_judgement'
];

    protected $primaryKey = 'social_service_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    public function social_service() {
        $this->belongsTo('App\SocialService');
    }
}
