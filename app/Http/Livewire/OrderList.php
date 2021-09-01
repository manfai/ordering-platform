<?php

namespace App\Http\Livewire;

use App\Models\Order\Order;
use Livewire\Component;

class OrderList extends Component
{

    public function viewDetail($orderId)
    {
        $this->emitTo('order-detail-card','viewingDetail', $orderId);
    }

    public function render()
    {
        $orders = auth()->user()->orders()->where('payment_status','paid')->orderBy('created_at','desc')->paginate(5);
        $coupons = auth()->user()->orders()->orderBy('created_at','desc')->paginate(3);
        $gifts = auth()->user()->orders()->orderBy('created_at','desc')->paginate(12);
        // dd($orders);
        return view('livewire.order-list',['orders'=>$orders]);
    }
}
