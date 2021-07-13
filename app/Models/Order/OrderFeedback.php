<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderFeedback extends Model
{

    public $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
