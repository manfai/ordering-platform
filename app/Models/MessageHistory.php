<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageHistory extends Model
{

    protected $casts = [
        'created_at' => 'datetime',
        'result' => 'array'
    ];

    public $guarded = [];
}

