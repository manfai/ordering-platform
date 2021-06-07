<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use OptimistDigital\MediaField\Models\Media;

class Post extends Model 
// implements Sortable
{
    use HasTranslations, SoftDeletes;
    // SortableTrait

    public $translatable = ['title', 'content', 'description'];

    public function category()
    {
        return $this->belongsTo('App\Api\V1\Model\Category');
    }

    protected static function boot()
    {
        parent::boot();
        // 監聽模型創建事件，在寫入數據庫之前觸發
        static::creating(function ($model) {
            // 如果模型的 no 字段為空
            if (!$model->url) {
                // 調用 findAvailableNo 生成訂單流水號
                $model->url = date('YmdHis');
                // 如果生成失敗，則終止創建訂單
                if (!$model->url) {
                    return false;
                }
            }
        });
    }
   
    public function readable()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'thumbnail', 'id');
    }

    public function img()
    {
        return $this->belongsTo(Media::class, 'image', 'id');
    }


}

