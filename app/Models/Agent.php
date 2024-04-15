<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Agent extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'agents';
    protected $fillable = ['name', 'phone', 'address', 'email', 'price_offer'];
    public function fixed_supplies(): HasMany
    {
        return $this->hasMany(Fixed_supplies::class);
    }
    public function each_supplies(): HasMany
    {
        return $this->hasMany(Each_supplies::class);
    }
}