<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use DateTime;
use Illuminate\Support\Facades\Auth;

class SubMenu extends Component
{
    public $menu_quantity = 0;
    public $menu_date = 0;
    public $period = [];
    
    public function mount($type='normal',$filter = null)
    {
        
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
       
        $this->period = config('menu.date');
        if(Auth::check()){
            // if(in_array(Auth::user()->id ,['10207','32434'])){
            if(Auth::user()->buffur){
                $this->period = config('menu.date2');
            } else {
                $this->period = config('menu.date');
            }
        }
        // dd(config('menu.ordered'));
       
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
