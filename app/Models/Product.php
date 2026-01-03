<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_title',
        'product_description',
        'product_prices',
        'product_quantity',
        'product_category',
        'product_image'
    ];
}