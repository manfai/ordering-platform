<?php

namespace App\Nova;

use App\Nova\Actions\ExportOrders;
use App\Nova\Lenses\TotalRevenue;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Badge;
use OptimistDigital\NovaNotesField\NotesField;

class Order extends Resource
{

    // use HasMegaFilterTrait; // Important!!

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order\Order::class;
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = '1. Admin';
    public static $priority = 3;


    public static $tableStyle = 'tight';
    public static $showColumnBorders = true;
    
    public static $polling = true;
    public static $showPollingToggle = true;
    
    
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function label()
    {
        return __('Orders');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'extraction_code', 'no'
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
            ID::make()->sortable()->hideFromIndex(),

            Text::make('No', function () {
                return '<small>' . $this->no . '</small><br>' . '#' . $this->id;
            })->rules('required', 'max:255')->asHtml(),

            BelongsTo::make('User', 'User', 'App\Nova\User'),

            // Text::make('Platform')
            //     ->sortable()
            //     ->rules('required', 'max:255'),

            // Text::make('Method', 'payment_method')
            //     ->sortable()
            //     ->rules('required', 'max:255'),
                
            Text::make('Method', 'real_payment'),

            // Text::make('Code', 'extraction_code')
            //     ->rules('required', 'max:255'),

            Text::make('Amount', 'real_amount', function ($value) {
                return '$' . number_format($value, 2);
            })
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Status', 'payment_status')->options([
                'pending' => 'Pending',
                'paid' => 'Paid',
                'fail' => 'Fail',
                'error' => 'Error',
                'refund' => 'Refund',
                'refunded' => 'Refund',
                'cancelled' => 'Cancelled',
                'refunded_money' => 'Refunded Money',
                'declined' => 'Decclined',
            ])->onlyOnForms(),

            Badge::make('Status', 'payment_status')->map([
                'failed' => 'danger',
                'fail' => 'danger',
                'paid' => 'success',
                'error' => 'danger',
                'refund' => 'danger',
                'refunded' => 'danger',
                'pending' => 'info',
                'cancelled' => 'warning',
                'declined' => 'warning',
                'refunded_money' => 'warning',
            ]),

            // Select::make('Pick-Up', 'ship_status')->options([
            //     'no_request' => '---',
            //     'ready' => 'Ready',
            //     'picked' => 'Picked',
            //     'expired' => 'Expired',
            //     'cancelled' => 'Cancelled',
            //     'processing' => 'Processing',
            //     'declined' => 'Decclined',
            // ])->onlyOnForms(),

            // Badge::make('Pick-Up', 'ship_status')->map([
            //     'no_request' => 'info',
            //     'ready' => 'info',
            //     'picked' => 'success',
            //     'expired' => 'warning',
            //     'cancelled' => 'warning',
            //     'processing' => 'info',
            //     'declined' => 'warning',
            // ]),

            Boolean::make('Closed')->sortable()->hideFromIndex(),

            DateTime::make('Date', 'created_at')->sortable(),

            DateTime::make('Updated At')->hideFromIndex(),

            // Button::make('Remind User', 'bento_code')->loadingText('Sending..')->successText('Sent!'),

            KeyValue::make('Remark')->rules('json'),

            new Tabs('Tabs', [
                'Items' => [
                    HasMany::make('Items', 'items', 'App\Nova\OrderItem'),
                ],
                'Charges' => [
                    HasMany::make('Charges', 'charges', 'App\Nova\OrderCharge'),
                ],
                'Payments' => [
                    HasMany::make('Payments', 'payments', 'App\Nova\OrderPayment'),
                    HasMany::make('Refund', 'refunds', 'App\Nova\OrderRefund'),
                ],
                'Logs' => [
                    HasMany::make('Logs', 'logs', 'App\Nova\OrderLog'),
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
        return [
         
        ];
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
        return [
          ];
    }

    public static function perPageOptions()
    {
        return [25, 50, 100, 150];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereIn('store_id',[57])->orderBy('created_at','desc');
    }

    
}
