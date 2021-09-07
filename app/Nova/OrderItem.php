<?php

namespace App\Nova;

use App\Nova\Actions\ExportSchoolItem;
use App\Nova\Filters\MenuBento;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Number;
use OptimistDigital\NovaNotesField\NotesField;

class OrderItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order\OrderItem::class;

    public static $indexDefaultOrder = [
        'created_at' => 'desc'
    ];

    public static $tableStyle = 'tight';
    public static $showColumnBorders = true;
    
    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    // public static $searchRelations = [
    //     'user' => ['name', 'email', 'phone_no'],
    //     'product' => ['title','code','slug'],
    //     'store' => ['code','name']
    // ];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function label()
    {
        return __('Order Items');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
         'user_id','extraction_code',
    ];

    public static $priority = 3;
    public static $polling = false;
    public static $showPollingToggle = true;
    
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            BelongsTo::make('Order','Order')->onlyOnIndex(),
            BelongsTo::make('User','User'),
           
            BelongsTo::make('Product','Product')->searchable(),

            Text::make('Code', 'extraction_code')
            ->rules('required', 'max:255')->hideFromIndex(),

            // Text::make('Payment')->displayUsing(function() {
            //     $payment = $this->order?$this->order->payment_method:"---";
            //     return '<span class="whitespace-no-wrap px-2 py-1 mb-5 rounded-full uppercase text-xs font-bold bg-warning-light text-warning-dark"><small>'. $payment.'</small></span>';
            // })->onlyOnIndex()->asHtml(),
            
            Text::make('Detail', function () {
                $period = "";
                $color = "success";
                if(date('Y-m-d', strtotime($this->created_at)) < date('Y-m-d', strtotime($this->menu_date))){
                    $period = 'Pre-order';
                    $color = "danger";
                } else {
                    $color = "success";
                    $period = 'Buffur';
                    if(date('H:i',strtotime($this->created_at)) < date('H:i',strtotime('10:01'))){
                        $color = "danger";
                        $period = 'Pre-order';
                    }
                }
                // $payment = $this->order?$this->order->payment_method:"---";
                return '<span class="whitespace-no-wrap px-2 py-1 mr-3 mb-5 rounded-full uppercase text-xs font-bold bg-info-light text-info-dark"><small>'.$this->period.'</small></span>
                        <br><span class="whitespace-no-wrap px-2 py-1 mr-3 mb-5 rounded-full uppercase text-xs font-bold bg-'.$color.'-light text-'.$color.'-dark"><small>' . $period . '</small></span>';
            })->rules('required', 'max:255')->asHtml()->hideFromIndex(),


            Number::make('Quantity')->onlyOnIndex(),

            // Text::make('Period', 'period'),
            // BelongsTo::make('Store','Store','App\Nova\Store'),

            Date::make('Date', 'menu_date')->sortable(),

            Select::make('Status', 'status')->options([
                'no_request' => '---',
                'ready' => 'Ready',
                'fail' => 'Fail',
                'failed' => 'Failed',
                'paid' => 'Paid',
                'expired' => 'Expired',
                'pending' => 'Pending',
                'request_refund' => 'Request Refund',
                'refunded' => 'Refunded',
                'refunded_money' => 'Refunded Money',
                'picked' => 'Picked',
                'declined' => 'Declined',
                'error' => 'Error',
            ])->onlyOnForms(),

            Badge::make('Status', 'status')->map([
                'no_request' => 'secondary',
                'ready' => 'info',
                'fail' => 'danger',
                'failed' => 'danger',
                'pending' => 'warning',
                'paid' => 'success',
                'expired' => 'warning',
                'request_refund' => 'warning',
                'refunded' => 'danger',
                'refunded_money' => 'danger',
                'picked' => 'warning',
                'cancelled' => 'warning',
                'declined' => 'warning',
                'error' => 'warning',
            ]),

            // Button::make('Remind User','take_bento')->loadingText('Sending..')->successText('Sent!'),
            Text::make('remark'),

           
            Select::make('Ship Status', 'ship_status')->options([
                'no_request' => '---',
                'ready' => 'Ready',
                'picked' => 'Picked',
                'processing' => 'Processing',
                'expired' => 'Expired',
                'delivering' => 'Delivering',
                'cancelled' => 'Cancelled',
                'declined' => 'Declined',
                'error' => 'Error',
            ])->onlyOnForms(),

            Badge::make('Ship Status', 'ship_status')->map([
                'no_request' => 'info',
                'ready' => 'info',
                'picked' => 'success',
                'expired' => 'warning',
                'processing' => 'warning',
                'delivering' => 'info',
                'cancelled' => 'warning',
                'declined' => 'warning',
                'error' => 'warning',
            ])->hideFromIndex(),

            Select::make(__('Give Back'),'giveback')->options(
                [
                    '0' => '不需要還樽',
                    '1' => '需要還樽',
                    '2' => '已經還樽',
                    '3' => '已經還樽並退按金',
                ]
            )->displayUsingLabels()->hideFromIndex(),
            
            KeyValue::make('Ship Data')->rules('json'),

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
            // new PickedBentos(),
            // new Unconfirmed()
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereIn('store_id',[57])->where('status','<>','pending')->orderBy('created_at','desc');
    }

}
