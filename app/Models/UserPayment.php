<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Http\Api\V1\Model\Payment;

class UserPayment extends Model
{
     
    protected $fillable = [
        'payment_id', 'brand', 'name', 'key', 'value', 'remark', 'order','amount', 'user_id',
    ];
    
    protected $casts = [
        'remark' => 'json'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function getColorAttribute(){
        $color = 'F4912B';
        if($this->name){
            $color = '109BB4';
        }
        return '#'.$color;
    }
    
    // public function getImageAttribute(){
    //     return $this->payment();
    // }
    
    public function getEncodeNameAttribute(){
        return str_replace('xxxxxx',' xxxx xxxx ',$this->name);
    }

}
