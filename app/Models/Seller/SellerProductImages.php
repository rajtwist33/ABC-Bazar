<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProductImages extends Model
{
    protected $fillable = [
        'seller_product_id',
        'front_photo',
        'back_photo',
        'photo_with_box',
        'photo_with_battery_percentage',
        'photo_with_warrenty',
        'photo_with_model',
    ];
}
