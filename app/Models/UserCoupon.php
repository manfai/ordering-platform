<?php

namespace App\Models;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserCoupon extends Model
{
    protected $table = 'user_coupons'; 
    // protected $fillable = [
    //     'coupon_id', 'use_count', 'max_use', 'status', 'user_id','expired_at','publish_at','remark'
    // ];
    protected $guarded = [];  
    
    protected $casts = [
        'publish_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
 
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

   

}
