<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class SupplierBrand extends Model  
{
    use HasTranslations;

    protected $fillable = [
        'code', 'name', 'desc', 'image', 'status', 'active'
    ];

    public $translatable = ['name', 'desc', 'image'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Str::upper(Str::slug($value, '-'));
    }
}
