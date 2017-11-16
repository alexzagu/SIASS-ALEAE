<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprehension extends Model
{
    protected $fillable = [
        'social_service_id',
        'field1',
        'field2',
        'field3'
    ];

    public $timestamps = false;

    public function social_service() {
        $this->belongsTo('App\SocialService');
    }
}
