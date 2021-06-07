<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MachineType extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
}

