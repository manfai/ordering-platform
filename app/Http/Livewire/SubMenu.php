<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product\Menu;
use App\Models\Product\Product;

class SubMenu extends Component
{
    public function render()
    {
        $menu = Menu::with('products')->whereIn('menu_date', [date('Y-m-d'), '8888-12-31'])->whereIn('period_id', [2,8,15])->active()
        ->whereHas('locations', function ($query) {
            $query->whereNotNull('stock')->where([
                'store_id' => 54
            ]);
        })->first();
        $taggable = \DB::table('taggables')->whereIn('taggable_id',$menu->products()->pluck('product_id'))->get()->pluck('tag_id');
        $items = \Spatie\Tags\Tag::whereIn('id',$taggable)->get();
        return view('livewire.sub-menu',['items'=>$items]);
    }
}
