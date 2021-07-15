<?php

namespace App\Http\Livewire;

use App\Models\Order\Order;
use Livewire\Component;

class OrderDetailCard extends Component
{

    public $viewingDetail = false;
    public $order = null;

    protected $listeners = [
        'viewingDetail' => 'viewDetail',
    ];

    public function viewDetail(Order $order)
    {
        $this->viewingDetail = true;
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.order-detail-card');
    }
}
