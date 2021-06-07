<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use OptimistDigital\MediaField\Models\Media;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Supplier extends Model implements Sortable
{
    use HasTranslations, SortableTrait;

    public $translatable = ['name', 'description', 'image'];

    public $sortable = [
        'order_column_name' => 'priority',
        'sort_when_creating' => true,
        'sort_on_has_many' => true,
    ];

    public function users()
    {
        return $this->hasMany(SupplierUser::class);
    }
    
    public function brands()
    {
        return $this->hasMany(SupplierBrand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class,'brand_id','id');
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = Str::upper(Str::slug($value, '-'));
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'image', 'id');
    }

    public function getImageFileAttribute($value)
    {
        if($this->media){
            return $this->media->url;
        } else {
            if(!$this->image){
                if(!$this->getTranslation('image', 'en')){
                    return $this->getTranslation('image', 'zh-hk');   
                }
                return $this->getTranslation('image', 'en');   
            } else {
                // return $this->image;
                if(!$this->getTranslation('image', 'en')){
                    return $this->getTranslation('image', 'zh-hk');   
                }
                return $this->getTranslation('image', 'en');     
            }
        }
        // return $this->media->url;
        if($value != null) {
            if(!$this->getTranslation('image', 'en')){
                return $this->getTranslation('image', 'zh-hk');   
            }
            return $this->getTranslation('image', 'en');
        } else {
            if(!$this->getTranslation('image', 'en')){
                return $this->getTranslation('image', 'zh-hk');   
            }
            return $this->getTranslation('image', 'en');
        }
    }


    // public function setImageAttribute($value)
    // {
    //     // $this->setTranslations('image',[
    //     //     'zh-hk'=>$value,
    //     //     'zh-cn'=>$value,
    //     //     'en'=>$value,
    //     // ]);
    //     // $this->attributes['image'] = ;
    // }

}
