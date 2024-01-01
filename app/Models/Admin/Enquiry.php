<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'email',
        'address',
        'message'
    ];
    public function hasproduct(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

}
