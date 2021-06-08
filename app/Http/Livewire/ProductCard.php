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
        $this->image = $this->product->image ? $this->product->image : 'https://atlas-content-cdn.pixelsquid.com/assets_v2/140/1406081837838636780/jpeg-600/G03.jpg?modifiedAt=1';
    }

    public function addToCart($productId)
    {
        // dd($this->product);
        $this->emitTo('add-cart', 'addToCart', $productId);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
