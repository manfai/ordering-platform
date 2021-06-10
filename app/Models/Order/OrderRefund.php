<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Http\Api\V1\Model\Payment;
use OptimistDigital\NovaNotesField\Traits\HasNotes;
use App\OrderItem;
use App\OrderLog;

class OrderRefund extends Model
{

    use HasNotes;
    public $guarded = [];

    protected $casts = [
        // 'order_id' => 'json',
        // 'user_id' => 'json',
        // 'payment_id' => 'json',
        // 'payment_method' => 'json',
        // 'refund_type' => 'json',
        // 'refund_value' => 'json',
        'refunded' => 'boolean',
        // 'image' => 'json',
        // 'comment' => 'json',
        'remark' => 'json',
        'data' => 'json',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setRefundedAttribute($value)
    {
        if ($value == 1) {
            //REMARK: update order item status to refunded
            OrderItem::where([
                'id' => $this->order_item_id,
                'order_id' => $this->order_id,
                'user_id' => $this->user_id
            ])->update([
                'status' => 'refunded'
            ]);
            OrderLog::create([
                'order_id' => $this->order_id,
                'action' => 'refund',
                'remark' => 'Refunded:' . $this->value . ' By ' . $this->payment_method
            ]);
        }
        $this->attributes['refunded'] = $value;
    }
}
