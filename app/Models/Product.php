<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'products';
    protected $fillable = ['pro_name','pro_num','price','number_of_product'];


    public function suppliers(){
        return $this->belongsToMany('App\Models\Supplier');
    }
}
