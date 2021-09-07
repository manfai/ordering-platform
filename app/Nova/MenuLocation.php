<?php

namespace App\Nova;

use App\Http\Api\V1\Model\Machine;
use App\Http\Api\V1\Model\MachineProduct;
use App\Http\Api\V1\Model\StoreMachine;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Boolean;
use NovaButton\Button;
use App\Nova\Filters\MenuBento;
use App\Nova\Filters\MenuLocation as MenuStore;
use App\OrderItem;

class MenuLocation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product\MenuLocationStock::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $displayInNavigation = false;

    public function authorizedToDelete(Request $request)
    {
        return false;
    }
      
    public function authorizedToView(Request $request)
    {
        return false;
    }


    public static $perPageViaRelationship = 35;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // ID::make()->sortable(),
            BelongsTo::make('Product')->display(function(){
                return $this->product->title;
            })->onlyOnIndex()->searchable(),
            BelongsTo::make('Store')->display(function(){
                return $this->store->name;
            })->onlyOnIndex()->searchable(),
            Boolean::make('Active')->sortable(),
            // Button::make('Remind', 'remind_buffer')->loadingText('Sending..')->successText('Sent!'),
            Text::make('Preorder')->displayUsing(function() {
                $order = OrderItem::whereIn('period',['lunch','lunch_gm','lunch-gm','addorder'])
                ->where('status','paid')
                ->where('menu_date',$this->menu->menu_date)
                ->where('created_at','<=',date('Y-m-d',strtotime($this->menu->menu_date)).' 10:00:59') //only get preorder num.
                ->where('product_id',$this->product->id)
                ->where('store_id',$this->store_id)->get();
                return $order->sum('quantity');
            })->onlyOnIndex(),
            Number::make('Buffur','stock')->sortable(),
            Number::make('Sold')->sortable(),

            // Number::make('Price','special_price')->sortable(),
            // Button::make('- Buffer','minus_buffer')->reload(),
            // Button::make('+ Buffer','add_buffer')->reload(),
            Text::make('Machine')->displayUsing(function(){
                $machineList = StoreMachine::where('store_id',$this->store_id)->get()->pluck('machine_id');
                $machine = MachineProduct::where('product_type','like','%MenuLocationStock%')
                ->whereIn('machine_id',$machineList)
                ->whereDate('created_at', date('Y-m-d'))
                ->where([
                    'product_id'=>$this->product->id,
                ])->select('machine_id')->groupBy('machine_id')->get();
                if(count($machine)>0){
                    $machines = $machine->pluck('machine_id');
                    $result = "已上架：";
                    foreach ($machines as $key => $value) {
                        $result .= Machine::find($value)->name;
                        if($key!=count($machines))$result .= ', ';
                    }
                    return $result;
                }
                return "未上架";
            }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new MenuBento,
            new MenuStore
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            // new Lenses\OrderedProducts,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new Actions\StoreStatus)
            ->confirmText('Are you sure you want to update this location?')
            ->confirmButtonText('Yes')
            ->cancelButtonText("No"),
            (new Actions\BufferControl)->showOnTableRow(),
            (new Actions\RemindUser),
            // (new Actions\StockControl)
        ];
    }
}
