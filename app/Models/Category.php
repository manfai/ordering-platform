<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{

    use HasTranslations;

    public $translatable = ['name', 'desc', 'image'];

    public function posts()
    {
        return $this->hasMany('App\Api\V1\Model\Post');
    }

}
