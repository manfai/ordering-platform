<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use DateTime;

class SubMenu extends Component
{
    public $menu_quantity = 0;
    
    public function render()
    {
        $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))->whereIn('period_id', [18])->active()
        ->whereHas('locations', function ($query) {
            $query->whereNotNull('stock')->where([
                'store_id' => 57
            ]);
        })->get();
        $period = $menu->pluck('menu_date');
        $this->emitTo('product-list','startDate',$period[0]);
        // $startDate = new \DateTime('NOW');
        // $endDate = (new \DateTime('NOW'))->modify('+7 day');
        // $interval = \DateInterval::createFromDateString('1 day');
        // $period = new \DatePeriod($startDate, $interval, $endDate);
        // dd($period);

        return view('livewire.sub-menu',['items'=>$period]);
    }
}
