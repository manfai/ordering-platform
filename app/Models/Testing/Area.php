<?php

namespace App\Models;

use App\Models\Country;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;
use Kodeine\Metable\Metable;

class Area extends Model implements Sortable
{
    use SoftDeletes, HasTranslations, SortableTrait;

    public $translatable = ['name', 'image'];

    public $sortable = [
        'order_column_name' => 'priority',
        'sort_when_creating' => true,
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function childrenAreas()
    {
        return $this->hasMany(Area::class)->with('areas');
    }
    public function district(){
        return $this->hasMany(Area::class)->where('type','district');
    }

    public function subdistrict(){
        return $this->hasMany(Area::class)->where('type','sub-district');
    }

    public function point(){
        return $this->hasMany(Area::class)->where('type','point');
    }

    public function store(){
        return $this->hasMany(Store::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }

    public function parentDistrict(){
        return $this->belongsTo(SELF::class,'area_id')->where('type', 'district');
    }

    public function parentSupDistrict(){
        return $this->belongsTo(SELF::class,'area_id')->where('type', 'sub-district');
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function getSupDistrictAreaAttribute($value)
    {
        return $this->area->area;
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = str_replace(' ', '-', strtoupper($value));
    }

    protected static function boot()
    {
        parent::boot();
        // 監聽模型創建事件，在寫入數據庫之前觸發
        static::saving(function ($model) {
            // 如果模型的 no 字段為空
            if($model->area_id) {
                $model->country_id = Area::find($model->area_id)->country_id;
            }
        });
    }
}
