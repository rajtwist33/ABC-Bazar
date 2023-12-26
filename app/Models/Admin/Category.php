<?php

namespace App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'image',
        'file_path',
        'deleted_at',
    ];
    public static function hascategory(Request $request){
        return Category::get();
    }
}
