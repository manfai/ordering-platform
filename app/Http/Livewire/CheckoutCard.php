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
    public $payments, $coupons, $selected_coupon_price = 0;
    public $selected_payment, $selected_coupon;

    protected $listeners = [
        'payment_method' => 'paymentMethod',
        'coupon_choosed' => 'couponChoosed',
    ];

    public function paymentMethod($payment)
    {
        $this->selected_payment = $payment;
    }

    public function couponChoosed(Coupon $coupon)
    {
        $this->selected_coupon = $coupon->id;
        $this->selected_coupon_price = $coupon->value;
    }

    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
        $this->emit('system_message', 'Item Deleted');
        $this->emit('$refresh');
    }

    public function mount()
    {
        $this->cartItems = Auth::user()->cartItem()->get();
        $this->payments  = Payment::where('enable', 1)->get();
        $this->coupons   = Coupon::where('active', 1)->where('value', '>', 0)->inRandomOrder()->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.checkout-card');
    }
}
