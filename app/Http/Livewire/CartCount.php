<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCount extends Component
{
    public $quantity = 0;
    protected $listeners = ['refreshCart'=>'refreshingCart'];

    public function mount()
    {
        $this->quantity = \Auth::user()->cartItem()->sum('quantity');
    }
    public function refreshingCart()
    {
        $this->quantity = \Auth::user()->cartItem()->sum('quantity');
    }
    public function render()
    {
        return view('livewire.cart-count');
    }
}
