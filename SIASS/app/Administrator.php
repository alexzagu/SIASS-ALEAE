<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $fillable = [
        'user_id',
        'department',
        'phone',
        'phoneExtension'
    ];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public $timestamps = false;
}
