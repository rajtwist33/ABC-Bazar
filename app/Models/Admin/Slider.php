<?php

namespace App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'file_path',
    ];
    public static function hasslider(Request $request){
        return Slider::get();
    }
}
