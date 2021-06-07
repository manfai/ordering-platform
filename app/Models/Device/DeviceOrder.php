<?php

namespace App\Models\Device;

use Illuminate\Database\Eloquent\Model;
use App\Models\Device\Device;
use App\Order;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceOrder extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function device(){
        return $this->belongsTo(Device::class);
    }
}