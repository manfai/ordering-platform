<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BrandList extends Component
{
    public function checkoutNow(){
        $this->emitTo('checkout-card', 'checkout');
    }

    public function render()
    {
        return view('livewire.brand-list');
    }
}
