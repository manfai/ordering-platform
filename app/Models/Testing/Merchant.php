<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// use Kodeine\Metable\Metable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Merchant extends Model
{
    // use Metable;
    use HasTranslations, SoftDeletes;

    public $translatable = ['name','shortand'];

    protected $casts = [
        'active' => 'boolean',
        'expired_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function meta()
    {
        return $this->hasMany('App\Models\MerchantMeta');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_merchants', 'merchant_id', 'user_id');
    }
    
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Str::upper(Str::slug($value, '-'));
    }

}
