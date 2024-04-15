<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Supplier extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'suppliers';
    protected $fillable = ['name','address','phone'];

    public function products(){
        return $this->belongsToMany('App\Models\Product');
    }
    public function scraps(){
        return $this->belongsToMany('App\Models\Scrap');
    }
}
