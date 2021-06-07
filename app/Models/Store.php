<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Store extends Model implements Sortable
{

    use HasTranslations, SortableTrait, SoftDeletes;

    // protected $fillable = [
    //     'code','type','name','image','full_address','opening_time','closing_time','excluded_weekday','priority','active',
    // ];
    public $guarded = [];

    public $translatable = ['name', 'image', 'full_address'];

    public $sortable = [
        'order_column_name' => 'priority',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'opening_time' => 'time',
        'closing_time' => 'time',
        'excluded_weekday' => 'array',
    ];

    protected $spatialFields = [
        'point',
    ];

  
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }
    public function sub_district()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function machines()
    {
        return $this->belongsToMany(Machine::class, 'store_machines','store_id','machine_id')
                ->withPivot(['period_id'])
                ->withTimestamps()
                ->using(\App\Models\StoreMachine::class);
    }

    
    public function periods()
    {
        return $this->belongsToMany(Period::class, 'store_period' ,'store_id', 'period_id')
                    ->withPivot('active')
                    ->withTimestamps();
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Str::upper(Str::slug($value, '-'));
    }

    public function getFullAddressAttribute($value)
    {
        if($this->name){
            if($this->code == 'EC-ANYWHERE'){
                return $this->name;
            }
            return $this->name.', '.ucfirst($this->area->name).', '.ucfirst($this->area->country->name);
        } else {
            return '---';
        }
    }

}