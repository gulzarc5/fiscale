<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employee';
    protected $table = 'employee';

    protected $fillable = [
        'name', 'email', 'password','mobile','gender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
