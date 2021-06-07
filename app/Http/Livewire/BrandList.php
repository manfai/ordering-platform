<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BrandList extends Component
{

    public function changeBrand($brand){
        $this->emitTo('product-list','brandUpdate',$brand);
        // dd($brand);
    }

    public function render()
    {
        return view('livewire.brand-list');
    }
}
