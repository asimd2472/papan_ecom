<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Producttype extends Model
{
    use HasFactory;
    protected $table = 'producttype';

    protected $guarded = [];

    public function productCategory(): HasOne
    {
        return $this->HasOne(ProductCategory::class,'id', 'category_id');
    }
}
