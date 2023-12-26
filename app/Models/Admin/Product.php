<?php

namespace App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'product_code',
        'title',
        'description',
        'specification',
        'imperfections',
        'price',
        'status',
        'slug',
        'slug_display',
        'created_by',
        'deleted_at',
    ];

    public function hascategory(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function hasproduct_image(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function hasimperfection_image(){
        return $this->hasMany(ProductImperfectionImage::class,'product_id','id');
    }
    public static function hasproduct(Request $request){
        return Product::with('hasproduct_image','hasimperfection_image','hascategory')
        ->where('status',0)
        ->latest()
        ->paginate(9);
    }
}
