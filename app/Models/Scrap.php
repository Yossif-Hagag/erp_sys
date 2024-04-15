<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Scrap extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'scraps';
    protected $fillable = ['pro_name','pro_num','price','quantity'];
    
    public function suppliers(){
        return $this->belongsToMany('App\Models\Supplier');
    }
}
