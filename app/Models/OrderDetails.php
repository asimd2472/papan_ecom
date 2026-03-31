<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    protected $guarded = [];

    public function Product(): HasOne
    {
        return $this->HasOne(Product::class,'id', 'product_id');
    }

    public function productVariationDetails(): HasOne
    {
        return $this->HasOne(ProductVariation::class,'id', 'attribute_items_id');
    }
}
