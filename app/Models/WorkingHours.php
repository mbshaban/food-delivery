<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
    use HasFactory;
    protected $table = "working_hours";
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'seller_id'
    ];
}
