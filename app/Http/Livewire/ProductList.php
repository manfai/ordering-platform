<?php

namespace App\Http\Livewire;

use App\Models\Product\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $products;
    public $brand;

    protected $listeners = [
        'brandUpdate' => 'changeBrand',
    ];
 
    public function changeBrand($brand)
    {
        $this->brand = $brand;
        $this->loadProduct();
        $this->emitSelf('$refresh');
    }
    
    public function loadProduct()
    {
        $this->products = Product::where('price','>=','50');
        if($this->brand){
            $this->products = $this->products->where('brand_id',$this->brand);
        }
        $this->products = $this->products->limit(6)->get();
    }

    public function mount(){
        $this->loadProduct();
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}
