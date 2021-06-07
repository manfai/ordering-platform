<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodTime extends Model
{

    public function period()
    {
        return $this->belongsTo('App\Models\Period');
    }

}