<?php

namespace App\Models\Device;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Order;
use App\Models\Device\DeviceOrder;
use App\Models\Device\DeviceUser;

class Device extends Model
{
    protected $guarded=[];
    
    public function user(){
        return $this->hasOne('App\Models\Device\DeviceUser');
    }
    
    public function order(){
        return $this->hasOne('App\Models\Device\DeviceOrder');
    }

}
