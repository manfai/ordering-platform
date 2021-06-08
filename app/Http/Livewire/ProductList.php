<?php

namespace App\Http\Livewire;

use App\Models\Product\Menu;
use App\Models\Product\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $products = [];
    public $brand = 'ec_mart';
    public $search = '';

    protected $listeners = [
        'brandUpdate' => 'changeBrand',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function changeBrand(string $brand)
    {
        $this->brand = $brand;
        $this->loadProduct($brand);
        $this->emitSelf('$refresh');
    }

    public function loadProduct($brand)
    {
        $this->reset(['products']);
        $period_id = 2;
        if ($brand == 'ec_mart') {
            $period_id = 8;
        }
        // dd($period_id);
        $menu = Menu::with('products')->whereIn('menu_date', [date('Y-m-d'), '8888-12-31'])->where('period_id', $period_id)->active()
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 54
                ]);
            })->first();
        $this->products = $menu->products()->paginate();
        $this->emit('$refresh');
    }

    public function mount()
    {
        $this->loadProduct($this->brand);
    }

    public function render()
    {
        $this->loadProduct($this->brand);
        return view('livewire.product-list', [
            'products' => $this->products
        ]);
    }
}
