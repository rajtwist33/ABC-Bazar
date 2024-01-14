<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerProduct extends Model
{
    use HasFactory, SoftDeletes;
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
        'deleted_at',
        'slug',
        'slug_display'
    ];

    public function detail(){
        return $this->hasOne(SellerDetail::class, 'seller_product_id','id');
    }
    public function product_image(){
        return $this->hasOne(SellerProductImages::class,'seller_product_id','id');
    }
}
