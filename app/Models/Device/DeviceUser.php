<?php

namespace App\Models\Device;

use Illuminate\Database\Eloquent\Model;
use App\Models\Device\Device;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceUser extends Model
{
    use SoftDeletes;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function device(){
        return $this->belongsTo(Device::class);
    }

}