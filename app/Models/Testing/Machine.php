<?php

namespace App\Models;

use App\Models\VM\MachineType;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use HasTranslations, SoftDeletes;

    public $translatable = ['name'];

    public function point()
    {
        return $this->belongsTo(Area::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function machine_types()
    {
        return $this->belongsTo(MachineType::class, 'type_id');
    }

    public $guarded = [];
    protected $casts = [
        'arrived_date' => 'date'
    ];


    // public function newPivot(Model $parent, array $attributes=[], $table, $exists)
    // {
    //     if ($parent instanceof Store) {
    //         return new Store($parent, $attributes, $table, $exists);
    //     }
    //     return parent::newPivot($parent, $attributes, $table, $exists);
    // }

}
