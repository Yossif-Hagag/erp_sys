<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
// use Illuminate\Auth\Password\CanResetPassword;

class Admin extends Authenticatable implements Auditable
{
    use HasFactory,Notifiable;
    use \OwenIt\Auditing\Auditable;
    protected $guard ='admin';
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
