<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Coupon extends Model
{
    use HasTranslations, SoftDeletes;

    // protected $metaTable = 'posts_meta'; //optional.
    // public $translatedAttributes = ['name', 'image'];
    public $translatable = ['name', 'image', 'description'];
    protected $casts = [
        'expired_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        // 監聽模型創建事件，在寫入數據庫之前觸發
        static::creating(function ($model) {
            // 如果模型的 no 字段為空
            if (!$model->color) {
                // 調用 findAvailableNo 生成訂單流水號
                $model->color = static::findAvailableCode();
                // 如果生成失敗，則終止創建訂單
                if (!$model->color) {
                    return false;
                }
            }
        });
    }

    public static function findAvailableCode()
    {
        $code = str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        $code = strtoupper($code);
        return $code;
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }


    public function users()
    {
        return $this->belongsToMany(\App\User::class, 'user_coupons','user_id','coupon_id')
        ->withPivot(['use_count', 'status', 'publish_at', 'expired_at', 'max_use','updated_at']);
    }

    
}
