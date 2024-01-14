<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProduct extends Model
{
    protected $fillable = [
        'product_code',
        'model',
        'storage',
        'warenty_left',
        'battery_percentage',
        'woking_properly',
        'original_screen',
        'phone_unopened',
        'battery_original',
        'mobile_condition',
        'mdms_registered',
        'defect',
        'defect_description',
        'approved_status',
        'approved_by',
        'slug',
        'slug_display'
    ];
}
