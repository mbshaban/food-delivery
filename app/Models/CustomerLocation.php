<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLocation extends Model
{
    use HasFactory;
    protected $table = "customer_location";
    protected $fillable = [
        'longitude',
        'latitude',
        'map_address',
        'title',
        'address',
        'phone',
        'customer_id'
    ];}
