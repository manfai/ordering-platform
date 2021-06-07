<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $guarded = [];
    
    public function products() 
    {
        return $this->hasMany('App\Models\Product\MenuProduct');
    }

    public function period() 
    {
        return $this->belongsTo('App\Models\Period');
    }
}
