<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'product_title',
        'menu_id',
        'description',
        'seller_id',
        'price',
        'discount',
        'product_status',
        'isApproved',
        'product_image'
    ];
}
