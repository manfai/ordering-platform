<?php

namespace App\Http\Livewire;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $brand;
    public $title;
    public $image;

    public function mount()
    {
        $this->title = $this->product->title;
        $this->description = $this->product->description;
        $this->image = $this->product->image ? $this->product->image : 'https://image.freepik.com/free-psd/delivery-food-brown-box-mockup_181945-514.jpg';
    }

    public function addToCart($productId,$menuDate = null)
    {
        // dd($this->product);
        $this->emitTo('add-cart', 'addToCart', [$productId,$menuDate]);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
