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
    public $filter = null;
    public $tags = null;

    protected $listeners = [
        'brandUpdate' => 'changeBrand',
    ];

    public function updatingSearch()
    {
        // $this->resetPage();
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
        $this->brand = $brand;
        // $this->emit('$refresh');
    }

    public function mount($filter = null)
    {
        // dd($filter);
        if($filter!==null){
            $filter = base64_decode($filter);
            $filter = unserialize($filter);
            if(isset($filter['tag'])){
                $filter = $filter['tag'];
            }
        }
        $this->filter = $filter;
        $this->tags = \DB::table('taggables')->get();
        $this->loadProduct($this->brand);
    }

    public function addToCart($productId)
    {
        $this->emitTo('add-cart', 'addToCart', $productId);
    }

    public function render()
    {
        if($this->filter !== null){
            $perferences = [$this->filter];
        } else {
            $perferences = [];
        }
        // $this->loadProduct($this->brand);
        $period_id = [2];
        if ($this->brand == 'ec_mart') {
            $period_id = [8, 15];
        }
        $menu = Menu::with('products')->whereIn('menu_date', [date('Y-m-d'), '8888-12-31'])->whereIn('period_id', $period_id)->active()
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 54
                ]);
            })->first();
        if ($menu) {
            
            // dd($perferences);
            // dd($menu->products()->get()->pluck('id'));
            $filter = \DB::table('taggables')->whereIn('tag_id',$perferences)->get()->pluck('taggable_id');
            $products = $menu->products()->whereIn("product_id",$filter);
            // dd($products);
        } else {
            $products = [];
        }
        return view('livewire.product-list', [
            'products' => count($products->get()) ? $products->paginate(12) : [],
            'tag' => $filter
        ]);
    }
}
