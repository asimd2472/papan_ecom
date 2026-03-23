<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttributeItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ProductAttributeItemSpecification(): HasOne
    {
        return $this->HasOne(ProductAttributeItemSpecification::class,'attribute_item_id', 'id');
    }

    public function ProductAttributeItemImage(): HasMany
    {
        return $this->hasMany(ProductAttributeItemImage::class,'attribute_item_id', 'id');
    }

}
