<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Executive extends Authenticatable
{
    use Notifiable;

    protected $guard = 'executive';
    protected $table = 'executive';

    protected $fillable = [
        'name', 'email', 'password','mobile','gender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
