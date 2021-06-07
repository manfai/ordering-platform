<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\UserPayment;

class Payment extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'image', 'description'];

    public function scopeEnable($query)
    {
        return $query->where('enable', 1);
    }
    public function users(){
        return $this->hasMany(UserPayment::class);
    }
}