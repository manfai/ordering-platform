<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use NovaButton\Button;
use Eminiarts\Tabs\Tabs;

class Menu extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product\Menu::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $group = '1. Admin';
    public static $priority = 1;
    public static function label()
    {
        return __('Menus');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'menu_date'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        // ai discoun rate
        return [
            Boolean::make('Active'),
            Date::make('Date', 'menu_date')->displayUsing(function(){
                return ($this->menu_date == '8888-12-31')?'0000-00-00':date('Y-m-d',strtotime($this->menu_date));
            })->rules('required')->sortable(),

            // BelongsTo::make('Period','period')->searchable()->sortable(),
            // Boolean::make('Alert Text Active')->nullable()->hideFromIndex(),
            // Text::make('Alert Text')->nullable()->translatable()->hideFromIndex(),
            Text::make('Remark')->help('Only for internal remaark.')->hideFromIndex(),
            Text::make('Stores')->displayUsing(function(){
                return '<span class=""><small>'.$this->stores.'</small></span>';
            })->hideWhenCreating()->hideWhenUpdating()->asHtml(),

            new Tabs('Tabs', [
                'Locations' => [
                    HasMany::make('Location','Locations',MenuLocation::class),
                ],
                'Products' => [
                    BelongsToMany::make('Products','products', MenuProduct::class)->fields(function() {
                        return [
                        Boolean::make('Active'),
                        Number::make('Preset Buffer'),
                        Number::make('Special Price'),
                        ];
                    })->searchable(),
                ],
            ]),
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
        return [];
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('period_id', 18)->orderBy('menu_date','desc');
    }
}
