<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Period extends Model implements Sortable
{
    use HasTranslations, SortableTrait;

    public $translatable = ['title', 'description'];

    protected $casts = [
        'description_display' => 'boolean',
        'preorder_enabled' => 'boolean',
    ];

    public $sortable = [
        'order_column_name' => 'priority',
        'sort_when_creating' => true,
        'sort_on_has_many' => true,
      ];

    public function periodtime()
    {
        return $this->hasMany('App\Models\PeriodTime');
    }

}