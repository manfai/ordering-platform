<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class MerchantMeta extends Model
{

    public $table = 'merchant_meta';    
    
    public $guarded = [];    

    public function user()
    {
        return $this->belongsTo('App\Models\Merchant');
    }
    

}
