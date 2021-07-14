<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PeriodResource;
use App\MenuLocationStock;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return[
        //     'menu_id' => $this->id,
        //     'menu_date' => date('Y-m-d', strtotime($this->menu_date)),
        //     'alert_text' => $this->alert_text,
        //     'alert_text_active' => $this->alert_text_active,
        //     'period' => $this->period->title,
        //     // 'period' => new PeriodResource($this->period),
        //     // 'products' => MenuProductResource::collection($this->products)
        //     'products' => ProductResource::collection($this->whenLoaded('products'))
        // ];
        $menuProduct = [];
        if(isset($request->location)){
            if($request->location){
                $location = $request->location;
            } else {
                $location = 2;
            }
            $menuProduct = MenuLocationStock::where([
                'menu_id'=> $this->id,
                'store_id'       => $location,
                'active'         => 1
            ])->get()->pluck('product_id');
            \Log::info($menuProduct);
        } else {
            $menuProduct = MenuLocationStock::where([
                'menu_id'=> $this->id,
                'active'         => 1
            ])->get()->pluck('product_id');
        }

        
        return ProductResource::collection($this->whenLoaded('products')->whereIn('id',$menuProduct)->where('on_sale',1)->filter(function ($value, $key) use($menuProduct){
            // if( !in_array($value->id, $menuProduct)){
                // \Log::info('menuProduct_value;'.$value->id);
                // \Log::info($menuProduct);
                // return in_array($value->id, $menuProduct);
            // }
            return $value->pivot->active != 0;
            })
        )->sortByDesc('created_at');

    }
}
