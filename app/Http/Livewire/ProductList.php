<?php

namespace App\Http\Livewire;

use App\Models\Product\Menu;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $products = [];
    public $brand = 'ecbento';
    public $menu_date;
    public $period = [];
    public $search = '';
    public $type;
    public $filter = null;
    public $tags = null;

    protected $listeners = [
        'brandUpdate' => 'changeBrand',
        'startDate' => 'setStartDate'
    ];

    public function setStartDate($date)
    {   
        $this->menu_date = $date;
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

    public function mount($type = 'normal', $filter = null)
    {
        // dd($filter);
        if(Auth::check()){
            if(in_array(Auth::user()->id ,['10207','32493'])){
                $this->period = config('menu.date2');
            } else {
                $this->period = config('menu.date');
            }
        }
        try {
            $this->menu_date = current($this->period);
        } catch (\Throwable $th) {
            $this->menu_date = date('Y-m-d');
        }

        if($filter!==null){
            $filter = base64_decode($filter);
            $filter = unserialize($filter);
            if(isset($filter['tag'])){
                $filter = $filter['tag'];
            }
            if(isset($filter['menu_date'])){
                $filter = $filter['menu_date'];
                $this->menu_date = $filter;
            }
        }
        $this->filter = $filter;
        // dd($this->menu_date);
        $this->type = $type;
        $this->tags = \DB::table('taggables')->get();
        $this->loadProduct($this->brand);
    }

    public function addToCart($productId,$menuDate)
    {
        // dd($menuDate);
        $this->emitTo('add-cart', 'addToCart', $productId, $menuDate);
    }

    public function render()
    {
        // dd($this->menu_date);
        $period_id = [18];
        $menu = Menu::where([
            'menu_date' => $this->menu_date,
        ])->whereIn('period_id',$period_id)->first();
        if ($menu) {
            $products = $menu->products();
            $products = $products->paginate(12);
            $filter = $this->filter;

        } else {
            $products = [];
            $filter = [];
        }
        return view('livewire.product-list', [
            'products' => $products,
            'tag' => $filter,
            'menu_date' => $filter
        ]);
    }
}
