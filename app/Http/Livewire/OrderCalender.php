<?php

namespace App\Http\Livewire;

use DateInterval;
use DatePeriod;
use DateTime;
use Livewire\Component;

class OrderCalender extends Component
{
    public $ordered, $period = [];

    public function mount()
    {
        $start    = new DateTime();
        $start->modify('first day of this month');
        $end      = new DateTime();
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 day');
        $period   = new DatePeriod($start, $interval, $end);
        $this->period[] = $period;


        $ordered = \App\Models\Order\OrderItem::where([
        'user_id'=>auth()->user()->id,
        'status'=>'paid'
        ])->whereIn('menu_date',config('menu.date'))->get();
        try {
            $this->ordered = $ordered->pluck('menu_date')->map(function ($value){
                return date('Y-m-d',strtotime($value));
            });
            $this->ordered = $this->ordered->all();
            // dd($this->ordered);
        } catch (\Throwable $th) {
            $this->ordered = [];
        }
    }

    public function render()
    {
        return view('livewire.order-calender');
    }
}
