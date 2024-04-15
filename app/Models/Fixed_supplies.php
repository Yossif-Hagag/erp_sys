<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fixed_supplies extends Model
{
    use HasFactory;
    protected $fillable = ['pro_num','pro_name','number_of_product','sell_price','buy_price','Contract_file',
];

    public function agents():BelongsTo{
        return $this->belongsTo(Agent::class);
         }
}