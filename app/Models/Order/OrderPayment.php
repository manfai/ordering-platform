<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Http\Api\V1\Model\Payment;

class OrderPayment extends Model
{
    public $guarded = [];

    protected $casts = [
        'data' => 'json',
    ];

    // protected $dates = [
    //     'paid_at',
    // ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
