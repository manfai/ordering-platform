<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use OptimistDigital\MediaField\Models\Media;

class Gift extends Model
{
    use HasTranslations, SoftDeletes;
    protected $guarded=[];

    // protected $metaTable = 'posts_meta'; //optional.
    // public $translatedAttributes = ['name', 'image'];
    public $translatable = ['name', 'description'];  
    
    public function media()
    {
        return $this->belongsTo(Media::class, 'image', 'id');
    }
    
}
