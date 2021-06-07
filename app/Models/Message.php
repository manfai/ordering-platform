<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Message extends Model
{

    use HasTranslations;

    public $translatable = ['content'];

    protected $casts = [
        'created_at' => 'datetime',
        'active_date' => 'datetime',
    ];

    public $guarded = [];

}
