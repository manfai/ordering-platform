<?php

namespace App\Models\VM;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MachineType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public function skus() 
    {
        return $this->hasMany('App\Models\Product\ProductSku');
    }


}

