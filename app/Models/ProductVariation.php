<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'color',
        'size',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
