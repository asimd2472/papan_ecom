<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserShippingAddress extends Model
{
    use HasFactory;
    protected $table = 'user_shipping_address';
    protected $guarded = [];

    public function Countries(): HasOne
    {
        return $this->HasOne(Countries::class,'id', 'country');
    }
}
