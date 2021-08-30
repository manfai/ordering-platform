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
        $menu = Menu::with('products')->whereIn('menu_date', [date('Y-m-d'), '8888-12-31'])->whereIn('period_id', [2,8,15])->active()
        ->whereHas('locations', function ($query) {
            $query->whereNotNull('stock')->where([
                'store_id' => 54
            ]);
        })->first();
     
        $taggable = \DB::table('taggables')->whereIn('taggable_id',$menu->products()->pluck('product_id'))->get()->pluck('tag_id');
        // $items = \Spatie\Tags\Tag::whereIn('id',$taggable)->get();

        $startDate = new \DateTime('NOW');
        // $endDate = (new \DateTime('NOW'))->modify('last day of this month');
        $endDate = (new \DateTime('NOW'))->modify('+30 day');

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($startDate, $interval, $endDate);
        return view('livewire.sub-menu',['items'=>$period]);
    }
}
