<?php

namespace App\Http\Livewire;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductCard extends Component
{
    public $product = [];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart($productId)
    {
        $this->emitTo('add-cart','addToCart',$productId);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
