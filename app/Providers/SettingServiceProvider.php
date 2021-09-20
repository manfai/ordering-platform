<?php

namespace App\Providers;

use App\Models\Product\Menu;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Auth;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $cache)
    {
        $type = 'normal';
        if($type == 'normal'){
            $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))->whereIn('period_id', [18])->active()
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 57
                ]);
            })->get();
        } else {
            $menu = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))
            // ->where('menu_date', '<=', date('Y-m-d',strtotime('last day of this month')))
            ->whereIn('period_id', [18])
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 57
                ]);
            })->get();
        }

        $menu2 = Menu::with('products')->where('menu_date', '>=', date('Y-m-d'))
        // ->where('menu_date', '<=', date('Y-m-d',strtotime('last day of this month')))
        ->whereIn('period_id', [18])
            ->whereHas('locations', function ($query) {
                $query->whereNotNull('stock')->where([
                    'store_id' => 57
                ]);
        })->get();
        
        $menu_date = $cache->remember('menu_date', 60, function() use ($menu){
            // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
            return $menu->pluck('menu_date')->all();
        });
        $menu_date2 = $cache->remember('menu_date2', 60, function() use ($menu2){
            // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
            return $menu2->pluck('menu_date')->all();
        });
        config()->set('menu.date', $menu_date);
        config()->set('menu.date2', $menu_date2);
    }
}
