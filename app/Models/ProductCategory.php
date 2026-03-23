<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'productcategory';

    protected $guarded = [];

    public function catrgory_brand(): HasMany
    {
        return $this->hasMany(Catrgory_brand::class,'category_id', 'id');
    }

    public function producttype(): HasMany
    {
        return $this->hasMany(Producttype::class,'category_id', 'id');
    }



}
