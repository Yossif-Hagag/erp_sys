<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perm extends Model
{
    use HasFactory;

    protected $table = 'perms';
    protected $fillable = [
        'agent_id',
        'role',
        'perm',
    ];
}

