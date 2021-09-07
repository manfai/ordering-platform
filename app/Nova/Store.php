<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;

use GeneaLabs\NovaMapMarkerField\MapMarker;
use OptimistDigital\MediaField\MediaField;
use E2Consult\NovaChecklist\Checklist;

class Store extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Store::class;
    public static $displayInNavigation = false;

    public static $group = '1. Admin';
    public static $priority = 30;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static function label()
    {
        return __('Stores');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','code'
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
            Boolean::make('Active'),
            BelongsTo::make('Area','area','\App\Nova\SubDistrict')->display('name'),

            // Checklist::make('Task')
            // ->placeholder('Add another task')   // Defaults to "Add item"
            // ->withPlaceholderCount()            // Not active by default
            // ->logUsers()                        // Not active by default, accepts user-model column. Uses "name" when column isn't provided.
            // ->showTimestamps()                  // Not active by default
            // ->showItemStatusOnIndex()           // Not active by default
            // ->showCompletionOnIndex(),          // Not active by default
            

            Text::make('Code')
            ->rules('required', 'min:1', 'max:255')
            ->creationRules('unique:stores')
            ->updateRules('unique:stores,id,{{resourceId}}'),
            Text::make('Name')->translatable()->rules('required', 'min:1', 'max:255')->hideFromIndex(),
            Text::make('Full Address')->rules('required', 'min:1', 'max:255')->hideWhenUpdating()->hideWhenCreating(),
            // MapMarker::make("Point")
            // ->latitude('latitude')
            // ->longitude('longitude')
            // ->defaultZoom(14)
            // ->defaultLatitude(22.247723)
            // ->defaultLongitude(114.167844)->hideFromIndex(),
            // MediaField::make('Image')->collection('media')->hideFromIndex(),
            BelongsToMany::make('Periods')->fields(function () {
                return [
                    Boolean::make('Active'),
                ];
            })->rules('required','unique:store_machines,machine_id'),
            BelongsToMany::make('Machines')->fields(function () {
                return [
                    Select::make('Period','period_id')->options([
                        '1' => 'Breakfast',
                        '2' => 'Lunch',
                        '3' => 'Dinner',
                        '4' => 'Drink',
                    ]),                    
                ];
            }),
            // Time::make('Openning Time')->help('Just for ref.'),
            // Time::make('Closing Time')->help('Just for ref.'),
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
        return [
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
        return [];
    }
}
