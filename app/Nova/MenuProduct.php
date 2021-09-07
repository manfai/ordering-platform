<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use NovaButton\Button;
use OptimistDigital\MediaField\MediaField;
use Laravel\Nova\Fields\Boolean;

class MenuProduct extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product\MenuProduct::class;
    // public static $model = 'App\MenuProduct';
    public static $perPageOptions = [50, 100, 150];
    public static $perPageViaRelationship = 40;

      
    public function authorizedToView(Request $request)
    {
        return false;
    }

    
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public function subtitle(){
        return $this->brand->name;
    }

    public static $displayInNavigation = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'code'
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
            ID::make()->sortable(),
            // Boolean::make('Active','active')->displayUsing(function ($field, $resource) {
            //     return $resource->active;
            // }),
            
            Text::make('Code'),

            Text::make('Title'),

            Number::make('Special Price')->displayUsing(function ($field, $resource) {
                return $resource->pivot->special_price;
            })->min(0)->step(0.1)->sortable(),
            Number::make('Stock')->displayUsing(function ($field, $resource) {
                return $resource->pivot->preset_buffer;
            })->sortable(),

            Boolean::make('Sale','on_sale'),

            // Button::make('Enable')->visible($this->active == false),

            // Button::make('Disable')->visible($this->active == true),

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
        return [];
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
            // new Lenses\MostOrderStores,
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
        ];
    }
}
