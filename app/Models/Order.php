<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_address',
        'receiver_phone',
        'user_id',
        'product_id',
        'status',
    ];

    // Order belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Order belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
