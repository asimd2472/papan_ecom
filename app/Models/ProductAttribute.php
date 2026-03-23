<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ProductAttributeItem(): HasMany
    {
        return $this->hasMany(ProductAttributeItem::class,'attribute_id', 'id');
    }


}
