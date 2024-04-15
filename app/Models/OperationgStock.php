<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationgStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'operation_type',
        'operation_document',
        'client_name',
        'address',
         'cost',
     ];
}
