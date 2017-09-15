<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'username',
        'role'
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function userInfo() {
        if ($this->role == 'administrator') {
            return $this->hasOne('App\Administrator');
        }

        if ($this->role == 'partner') {
            return $this->hasOne('App\Partner');
        }

        if ($this->role == 'student') {
            return $this->hasOne('App\Student');
        }

        return false;
    }
}
