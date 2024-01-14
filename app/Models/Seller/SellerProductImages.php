<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerProductImages extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'seller_product_id',
        'front_part',
        'back_part',
        'with_box',
        'with_battery_percentage',
        'with_warrenty',
        'with_model',
        'deleted_at',
    ];
}
