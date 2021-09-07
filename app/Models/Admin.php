<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    protected $guard = 'admin';
    
    protected $guard_name = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'locale'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}