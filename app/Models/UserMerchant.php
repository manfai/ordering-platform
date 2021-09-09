<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMerchant extends Model
{
     
    protected $fillable = [
       'user_id', 'type', 'remark', 'merchant_id'
    ];
    
    protected $casts = [
        'remark' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function getStudentsAttribute(){
        return $this->remark?$this->remark:[];
    }

}
