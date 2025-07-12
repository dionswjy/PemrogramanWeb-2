<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items'; // Sesuai dengan tabel yang sudah ada

    protected $fillable = [
        'cart_id',
        'itemable_id',
        'itemable_type',
        'quantity',
        'options'
    ];

    public function itemable()
    {
        return $this->morphTo();
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}