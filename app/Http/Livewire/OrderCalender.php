<?php

namespace App\Http\Livewire;

use DateInterval;
use DatePeriod;
use DateTime;
use Livewire\Component;

class OrderCalender extends Component
{
    public $period = [];

    public function mount()
    {
        $start    = new DateTime();
        $start->modify('first day of this month');
        $end      = new DateTime();
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 day');
        $period   = new DatePeriod($start, $interval, $end);
        $this->period[] = $period;
    }

    public function render()
    {
        return view('livewire.order-calender');
    }
}
