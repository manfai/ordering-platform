<?php

namespace App\Http\Resources;

use App\Http\Api\V1\Model\Store;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItemResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // dd($this->items->groupBy('Date(extraction_start)')->get()->toArray);
        // dd($request->sortBy);

        if ($request->sortBy == 'payment') {
            $sortBy = 'price';
        } else {
            $sortBy = 'created_at';
        }
        $order_status = order_status2($this->payment_status, $this->ship_status, $this->user->language);
        $payment_status = $order_status['payment_status'];
        $status = $order_status['status'];
        //  switch ($this->payment_status) {
        //     case 'paid':
        //          $payment_status = 'Request Refund';
        //          $status = 'Paid';
        //          break;

        //     case 'request_refund':
        //          $payment_status = 'Refund Requested';
        //          $status = 'Paid';
        //          break;

        //     case 'refunded':
        //         $payment_status = '';
        //         $status = 'Refunded';
        //         break;

        //     case 'refunded_coupon':
        //         $payment_status = 'Coupon Refunded';
        //         $status = 'Paid';
        //         break;

        //     case 'refunded_money':
        //         $payment_status = 'Money Refunded';
        //         $status = 'Paid';
        //         break;          

        //     case 'refund_denied':
        //         $payment_status = 'Money Refunded';
        //         $status = 'Ordered';
        //         break;

        //     case 'cancelled':
        //         $payment_status = '';
        //         $status = 'Order Cancelled';
        //         break;

        //      default:
        //         $payment_status = '';
        //         $status = 'Ordered';
        //          break;
        //  }
        //  dd($this->items);
        $remark = 'Revoke Reward: ' . $this->real_amount . ' Points';
        if ($this->items()->where('status', 'like', '%refunded%')->get()->count() > 0) {
            $totalRefund = $this->refunds()->where('refunded', 1)->get()->sum('refund_value');
            $remark = 'Refunded: $' . $totalRefund;
        }
        if ($this->items()->where('giveback', 1)->get()->count() > 0) {
            $remark = '需要歸還樽';
        }
        if ($this->items()->where('giveback', 2)->get()->count() > 0) {
            $remark = '已經歸還樽';
        }
        $item = $this->items()->first();
        $items = OrderItemResource::collection($this->items);
        $ext_code = count($this->items) > 0 ? $this->extraction_code : '000000';
        if($this->user_id == '10201'){
            $ext_code = 'ecb'.$ext_code;
        }
        return [
            'id'        => $this->id,
            'status'    => $status,
            'payment_status' => $payment_status,
            // 'request' => 'Feedback',  //Request Refund, Feedback, Cancel Order, if payment_status cancelled -> this empty too
            'extraction_code' => $ext_code,
            'real_amount'     => $this->real_amount,
            'items'     => $items,
            // 'remark' => 'Revoke Reward: '.$this->real_amount.' Points',
            'remark' => $remark,
            'location' => $item ?  $item->store->name : 0,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
    }

    public function detail($order)
    {
        return 'asjdajksd';
    }
}
