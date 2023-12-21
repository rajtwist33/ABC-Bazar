<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductImperfectionImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_id',
        'image',
        'file_path',
        'deleted_at',
    ];
}
