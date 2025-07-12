<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'shipping_method_id',
    'payment_method_id',
    'order_number',
    'subtotal',
    'shipping_cost',
    'total',
    'status',
    'customer_name',
    'shipping_address',
    'shipping_city',
    'shipping_province',
    'shipping_postal_code',
    'shipping_phone',
    'shipping_email',
    'tracking_number',
    'notes'
];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function payment_confirmation()
    {
        return $this->hasOne(PaymentConfirmation::class);
    }
}
