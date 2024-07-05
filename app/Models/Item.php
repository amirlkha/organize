<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=[
        'category',
        'type',
        'price', 
        'group_quantity', 
        'group_weight',
        'current_stock'

    ];
}
