<?php

namespace App\Models\Product;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// use OptimistDigital\MediaField\Models\Media;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, HasTags;

    // protected $fillable = [
    //     'slug','code','title','description','image','package','on_sale','discount','rating','sold_count','review_count','price','brand_id','thumbnail'
    // ];

    public $translatable = ['title', 'image', 'description'];
    public $guarded = [];

    protected $casts = [
        'on_sale' => 'boolean',
        'discount' => 'boolean',
        'has_addon' => 'boolean',
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    protected static function boot()
    {
        // \Log::info('hi');
        parent::boot();
        // \Log::info('hello');
        static::created(function ($model) {
            // Create default sku 
            // dd('123');
            // \Log::info('yea');
            if ($model->package == 'single') {
                // Remove all skus if changed to single
                // $model->skus()->delete();
                \Log::info('yo');
                $sku = [
                    'slug' => $model->slug,
                    'code' => $model->code,
                    'title' => $model->title,
                    'description' => $model->description,
                    'image' => $model->image,
                    'same_price' => true,
                    'price' => $model->price,
                    'stock' => 99999,
                    'on_sale' => true,
                    'discount' => false,
                    'has_addon' => false,
                ];
                $model->skus()->create($sku);
            }
        });
    }


    public function brand()
    {
        return $this->belongsTo('App\Models\Supplier', 'brand_id', 'id');
    }

    public function categorys()
    {
        return $this->hasMany('App\Models\Product\ProductCategory');
    }

    public function prices()
    {
        return $this->morphMany('App\Models\Product\ProductPrice', 'price');
    }

    public function skus()
    {
        return $this->hasMany('App\Models\Product\ProductSku');
    }

    public function suppliers()
    {
        return $this->hasMany('App\Models\Supplier', 'id', 'brand_id');
    }
    public function supplier()
    {
        return $this->hasOne('App\Models\Supplier', 'id', 'brand_id');
    }


    public function media()
    {
        return $this->belongsTo(Media::class, 'thumbnail', 'id');
    }

    public function scopeWithTranslation(Builder $query, $locale = null)
    {
        $locale = $locale ?? $this->locale();

        $query->with([
            'translations' => function (Relation $query) use ($locale) {
                if ($this->useFallback()) {
                    $countryFallbackLocale = $this->getFallbackLocale($locale); // e.g. de-DE => de
                    $locales = array_unique([$locale, $countryFallbackLocale, $this->getFallbackLocale()]);

                    return $query->whereIn($this->getTranslationsTable() . '.' . $this->getLocaleKey(), $locales);
                }

                return $query->where($this->getTranslationsTable() . '.' . $this->getLocaleKey(), $locale);
            },
        ]);
    }

    public function getImageFileAttribute($value)
    {
        if ($this->media) {
            return $this->media->url;
        } else {
            if (!$this->image) {
                if (!$this->getTranslation('image', 'en')) {
                    return $this->getTranslation('image', 'zh-hk');
                }
                return $this->getTranslation('image', 'en');
            } else {
                return $this->image;
            }
        }
        // return $this->media->url;
        if ($value != null) {
            if (!$this->getTranslation('image', 'en')) {
                return $this->getTranslation('image', 'zh-hk');
            }
            return $this->getTranslation('image', 'en');
        } else {
            if (!$this->getTranslation('image', 'en')) {
                return $this->getTranslation('image', 'zh-hk');
            }
            return $this->getTranslation('image', 'en');
        }
    }

    public function getChineseNameAttribute()
    {
        return $this->getTranslation('title', 'zh-hk');
        // return route('images.product', ['slug' => $this->slug]);
    }

    public function getPreferencesAttribute($value)
    {
        // \Log::info('preferences');
        // \Log::info();
        // $newsItem->syncTags(['first tag', 'second tag']); // all other tags on this model will be detached
        return $this->tagsWithType('preferences')->pluck('name');
        // return route('images.product', ['slug' => $this->slug]);
    }
    public function setPreferencesAttribute($value)
    {
        // \Log::info('update preferences');
        // \Log::info($value);
        return $this->syncTagsWithType($value, 'preferences'); // all other tags on this model will be detached
        // return $this->attributes('preferences');
        // return route('images.product', ['slug' => $this->slug]);
    }


    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Str::upper(Str::slug($value, '-'));
    }
}
