<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'product';

    protected $guarded = [];

    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class,'product_id', 'id');
    }

    public function productCategory(): HasOne
    {
        return $this->HasOne(ProductCategory::class,'id', 'category_id');
    }

    public function Producttype(): HasOne
    {
        return $this->HasOne(Producttype::class,'id', 'type_id');
    }

    public function ProductAttributeItem(): HasMany
    {
        return $this->hasMany(ProductAttributeItem::class,'product_id', 'id');
    }

    public function ProductAttribute(): HasMany
    {
        return $this->hasMany(ProductAttribute::class,'product_id', 'id');
    }

    public function ProductAttributeItemSpecification(): HasMany
    {
        return $this->hasMany(ProductAttributeItemSpecification::class,'product_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

}
