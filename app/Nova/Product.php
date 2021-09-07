<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use OptimistDigital\MediaField\MediaField;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\MorphMany;
use NovaButton\Button;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product\Product::class;
    
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    // public static $group = '1. Admin';
    public static $priority = 5;
    public static $displayInNavigation = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'slug', 'code', 'title',
    ];

    public function title()
    {
        return $this->title; 
    }

    public function subtitle()
    {
        return "Supplier: {$this->brand->name}";
    }

    public static function label()
    {
        return __('Products');
    }

     /**
     * Return the location to redirect the user after creation.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
        // return '/resources/'.$request->viaResource.'/'.$request->viaResourceId;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()->hideFromIndex(),

            Text::make('Slug')->help('Show on the product url')
            ->rules('required', 'min:1', 'max:64')
            ->creationRules('unique:products')
            ->hideFromIndex(),
            Text::make('Code')->rules('required', 'min:1', 'max:64')
            ->creationRules('unique:products'),
            // MediaField::make('Thumbnail')->collection('products')
            // ->creationRules('required')
            // ->updateRules('nullable')
            // ->hideFromIndex(),
            
            Text::make('Title','title')->rules('required', 'min:2', 'max:150')->translatable(),
            TextArea::make('Description')->translatable(),
            // Checkboxes::make('Preferences')
            // ->options(\Spatie\Tags\Tag::where('type','preferences')->orderBy('order_column')->get()->keyBy('name')->map(function($item,$key){ 
            //     return $item['name'];
            // }))->creationRules('required')->hideFromIndex()->hideWhenCreating(),

            // Select::make('Category', 'categories')->options(\Spatie\Tags\Tag::where('type','categories')->get()->keyBy('name')->map(function($item,$key){ 
            //     return $item['name'];
            // }))->displayUsingLabels()->rules('required'),

            Select::make('Brand', 'brand_id')->options(
                DB::table('suppliers')->get()->keyBy('id')->map(function($item){
                    return $item->code;
                })
            )->displayUsingLabels()->rules('required'),

            // BelongsTo::make('Supplier','brand','App\Nova\Supplier'),
            // HasOne::make('Suppliers','brand'),
            // Tags::make('Tags')->help(
            //     'Click Enter for each tag'
            // )->type('preferences')->hideFromIndex(),
            Select::make('Package')->options([
                'single' => 'Single',
                'multiple' => 'Multiple'
            ])->displayUsingLabels()->rules('required')->hideFromIndex(),
         

            Number::make('Price')->min(0)->step(0.1)->rules('required'),
            Number::make('Special Price','discount')->min(0)->step(0.1),
            // Select::make('Supplier')->options([
            //     BelongsTo::make('Client')
            // ])->displayUsingLabels(),
            // BelongsTo::make('Suppliers'),
          

            // Number::make('Rating')->exceptOnForms(),
            // Number::make('Sold Count')->exceptOnForms()->hideFromIndex(),
            // Number::make('Review Count')->exceptOnForms()->hideFromIndex(),
         
            Boolean::make('On Sale'),

            // Button::make('Disable')->visible($this->on_sale == 1)->onlyOnIndex(),
            // Button::make('Enable')->visible($this->on_sale == 0)->onlyOnIndex(),

            MorphMany::make('Cost', 'prices' ,'App\Nova\ProductPrice')
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
}
