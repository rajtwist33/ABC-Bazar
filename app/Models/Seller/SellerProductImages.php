<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProductImages extends Model
{
    protected $fillable = [
        'seller_product_id',
        'front_part',
        'back_part',
        'with_box',
        'with_battery_percentage',
        'with_warrenty',
        'with_model',
    ];
}
