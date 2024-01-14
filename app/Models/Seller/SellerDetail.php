<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'seller_product_id',
        'name',
        'phone',
        'email',
        'province',
        'city',
        'zip_code',
        'agreed',
        'deleted_at',
    ];
}
