<?php

namespace App\Http\Livewire;

use App\Models\Product\Menu;
use Livewire\Component;

class HitProduct extends Component
{
    public function render()
    {
        $period_id = [15];
        $menu = Menu::with('products')->whereIn('menu_date', [date('Y-m-d'), '8888-12-31'])->whereIn('period_id', $period_id)->active()
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 54
                ]);
            })->first();
        if ($menu) {
            $products = $menu->products()->inRandomOrder()->get()->take(3);
        } else {
            $products = [];
        }

        return view('livewire.hit-product',['products'=>$products]);
    }
}
