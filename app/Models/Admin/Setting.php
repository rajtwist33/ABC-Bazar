<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'image',
        'file_path',
        'deleted_at',
    ];
}
