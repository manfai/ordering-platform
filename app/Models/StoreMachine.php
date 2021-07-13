<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreMachine extends Pivot
{
    protected $table='store_machines';
    protected $guarded=[];
    // protected $casts = [
    //     'menu_date' => 'date'
    // ];

    public function store()
    {
        return $this->belongsTo(App\Models\Store::class,'store_id');
    }

    public function machine()
    {
        return $this->belongsTo(App\Models\Machine::class,'machine_id');
    }
  
    public function period()
    {
        return $this->belongsTo(App\Models\Period::class,'period_id');
    }

}
