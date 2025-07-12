<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model
{
    protected $fillable = [
        'order_id',
        'bank_name',
        'account_name',
        'transfer_amount',
        'transfer_date',
        'payment_proof',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
