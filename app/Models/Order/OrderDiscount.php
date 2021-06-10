<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDiscount extends Model
{

    public $guarded = [];

    protected $casts = [
        'remark' => 'array',
        'data' => 'json',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
