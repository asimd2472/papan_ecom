<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $guarded = [];

    public function UserBillingAddress(): HasOne
    {
        return $this->HasOne(UserBillingAddress::class,'id', 'billing_id');
    }

    // public function UserShippingAddress(): HasOne
    // {
    //     return $this->HasOne(UserShippingAddress::class,'id', 'shipping_id');
    // }

    public function OrderDetails(): HasMany
    {
        return $this->HasMany(OrderDetails::class,'order_id', 'id');
    }

    public function UserShippingAddress(): HasOne
    {
        return $this->HasOne(DeliveryLocations::class,'id', 'shipping_id');
    }

    
}
