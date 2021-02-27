<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = [
        'type',
        'category_webaddress',
        'category_name',
        'category_image',
        'category_description'
    ];
}
