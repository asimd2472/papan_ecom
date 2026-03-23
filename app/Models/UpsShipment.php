<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpsShipment extends Model
{
    use HasFactory;
    protected $table = 'ups_shipment';
    protected $guarded = [];
}
