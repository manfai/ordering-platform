<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SupplierMeta extends Model
{
    use HasTranslations;

    public $translatable = ['address'];


    public $table = 'supplier_meta';    
    
    public $guarded = [];    

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
    


}
