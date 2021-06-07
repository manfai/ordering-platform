<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Api\V1\User;

class Cart extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

}
