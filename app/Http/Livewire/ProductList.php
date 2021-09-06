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
        $this->menu_date = date('Y-m-d');
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
        
        if($this->filter !== null){
            $perferences = [$this->filter];
            $menu_date = $this->filter;
        } else {
            $menu_date = date('Y-m-d');
            $perferences = [];
        }
        // $this->loadProduct($this->brand);
        $period_id = [18];
        // if ($this->brand == 'ec_mart') {
        //     $period_id = [8, 15];
        // }
        if($this->type == 'normal'){
           
            $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))->whereIn('period_id', [18])->active()
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 57
                ]);
            })->get();
        } else {
            $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))->where('menu_date', '<=', date('Y-m-d',strtotime('last day of this month')))->whereIn('period_id', [18])
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 57
                ]);
            })->get();
        }
       


        $this->period = $menu->pluck('menu_date');
        $menu = $menu->where('menu_date','>=',$menu_date)->first();
        // dd($menu);
        $this->menu_date = $menu->menu_date;

        if ($menu) {
            
            // dd($perferences);
            // dd($menu->products()->get()->pluck('id'));
            // $filter = \DB::table('taggables')->whereIn('tag_id',$perferences)->get()->pluck('taggable_id');
            
            $products = $menu->products();
            // if($perferences){
            //     $products = $products->whereIn("product_id",$filter);
            // }
            $products = $products->paginate(12);
            $filter = $this->filter;
            // dd();
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
