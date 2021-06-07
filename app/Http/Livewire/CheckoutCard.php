<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutCard extends Component
{
    public $cartItems;
    public $payments, $coupons;

    public function removeItem(CartItem $cartItem){
        $cartItem->delete();
        $this->emit('system_message','Item Deleted');
        $this->emit('$refresh');
    }

    public function mount(){
        $this->cartItems = Auth::user()->cartItem()->get();
        $this->payments  = Payment::where('enable',1)->get();
        $this->coupons   = Coupon::where('active',1)->where('value','>',0)->inRandomOrder()->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.checkout-card');
    }
}
