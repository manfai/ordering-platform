<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use OptimistDigital\NovaNotesField\Traits\HasNotes;

class SupplierUser extends Model
{
    use HasNotes;

    // public $translatable = ['address'];


    // public $table = 'supplier_users';    
    
    public $guarded = [];    

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }


}
