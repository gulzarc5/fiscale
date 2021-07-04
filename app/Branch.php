<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Branch extends Authenticatable
{
    use Notifiable;

    protected $guard = 'branch';
    protected $table = 'branch';

    protected $fillable = [
        'name', 'email', 'password','mobile',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
