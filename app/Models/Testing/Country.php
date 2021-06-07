<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'nicename'];

    public function area(){
        return $this->hasMany(Area::class)->where('type','area');
    }

}
