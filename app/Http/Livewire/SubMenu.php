<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use DateTime;

class SubMenu extends Component
{
    public $menu_quantity = 0;
    public $menu_date = 0;
    public $period = [];
    
    public function mount($type='normal',$filter = null)
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


        if($type == 'normal'){
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
       
    }


    public function render()
    {
        $period = $this->period;
        $this->emitTo('product-list','startDate',$period[0]);
        // $startDate = new \DateTime('NOW');
        // $endDate = (new \DateTime('NOW'))->modify('+7 day');
        // $interval = \DateInterval::createFromDateString('1 day');
        // $period = new \DatePeriod($startDate, $interval, $endDate);
        // dd($period);

        return view('livewire.sub-menu',['items'=>$period]);
    }
}
