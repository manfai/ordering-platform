<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineMeta extends Model
{
    public $table = 'machine_meta';    
    
    public $guarded = [];    

    public function machine()
    {
        return $this->belongsTo('App\Models\Machine');
    }
}

