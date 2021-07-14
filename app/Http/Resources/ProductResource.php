<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;
use App\MenuLocationStock;
use JWTAuth;
use App\Http\Api\V1\Model\Period;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Api\V1\Model\CartItem;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (isset($request->language)) {
            $supportLanguage = array("zh-HK", "zh-CN", "en", "zh-hk", "zh-cn");
            if (!in_array($request->language, $supportLanguage)) {
                $lang = 'en';
            } else {
                $lang = strtolower($request->language);
            }
        } else {
            $lang = 'en';
        }

        // dd($this);
        $locationPrice = $this->price ? $this->price : 0;
        $locationStock = 0;
        $totalStock = 0;

        if (isset($request->location)) {
            $period = Period::find($request->period);
            $start_period = $period->start;
            $end_period = $period->end;
            $period = $period->preorder_end;
        } else {
            $end_period = "23:59:59";
            $start_period = "00:00:00";
            $period = "23:59:59";
        }

        if (isset($request->location)) {
            if ($request->location) {
                $location = $request->location;
            } else {
                $location = 2;
            }
            $locationStock = MenuLocationStock::where([
                'menu_product_id' => $this->pivot->id,
                'product_id'     => $this->id,
                'store_id'       => $location,
                'active'         => 1
            ])->first();
            if ($locationStock) {
                //REMARK: < 10AM preorder + buffer
                $locationPrice = $locationStock->price;

                if ($request->date . ' ' . $period >= date('Y-m-d H:i:s')) {
                    // $locationStock = $this->pivot->preset_buffer - $locationStock->sold;
                    $locationStock = $this->pivot->preset_buffer - $this->pivot->real_stock;
                    \Log::info($this->getTranslation('title', $lang) . ' - TEsting Stock');
                    \Log::info($this->pivot->preset_buffer);
                    \Log::info($this->pivot->real_stock);
                    if ($locationStock < 0) {
                        $locationStock = 0;
                    }
                } else {

                    $v1buffer = check_buffer_v1($location, $this->id);
                    if (!$v1buffer) {
                        $locationStock = $locationStock->real_stock;
                        if ($request->period == 3) {
                            if (date('H:i:s') >= '17:30:00') {
                                $locationStock = 0;
                            }
                        } else {
                            if (date('H:i:s') >= '14:30:00') {
                                if ($location < 50) {
                                    if ($request->period < 7) {
                                        $locationStock = 0;
                                    }
                                    // $locationStock = 0;
                                } else {
                                    if ($location < 55) {
                                    if ($request->period < 7) {
                                        $locationStock = 0;
                                    }
                                    }
                                }
                                // $locationStock = 0;
                            }
                            if (date('H:i:s') >= $end_period) {
                                if ($location <= 56) {
                                    if ($request->period !== 15) {
                                        $locationStock = 0;
                                    }
                                }
                            }
                        }
                    } else {
                        $cart_stock = CartItem::where([
                            'store_id' => $location,
                            'product_id' =>  $this->id,
                            'menu_date' => $request->date
                        ])->get()->sum('quantity');
                        $cart_stock = 0;
                        $v1buffer = 0;

                        // $locationStock = $v1buffer - $cart_stock;
                        $locationStock = $locationStock->real_stock;

                        if (date('H:i:s') >= '14:30:00') {
                            if ($location < 50) {
                                if ($request->period < 7) {
                                    $locationStock = 0;
                                }
                            }
                        }
                        
                       

                    }
                }
            } else {
                // return null;
                $locationStock = $totalStock;
            }
        } else {
            $location = 2;

            $locationStock = MenuLocationStock::where([
                'menu_product_id' => $this->pivot->id,
                'product_id'     => $this->id,
                'store_id'       => $location,
                'active'         => 1
            ])->first();
            if ($locationStock) {
                //REMARK: < 10AM preorder + buffer
                $locationPrice = $locationStock->price;
                if ($request->date . ' ' . $period >= date('Y-m-d H:i:s')) {
                    // $locationStock = $this->pivot->preset_buffer - $locationStock->sold;
                    $locationStock = $this->pivot->preset_buffer - $this->pivot->real_stock;
                    if ($locationStock < 0) {
                        $locationStock = 0;
                    }
                } else {
                    $v1buffer = check_buffer_v1($location, $this->id);
                    if (!$v1buffer) {
                        $locationStock = $locationStock->real_stock;
                    } else {
                        $cart_stock = CartItem::where([
                            'store_id' => $location,
                            'product_id' =>  $this->id,
                            'menu_date' => $request->date
                        ])->get()->sum('quantity');
                        $cart_stock = 0;
                        $v1buffer = 0;

                        // $locationStock = $v1buffer - $cart_stock;
                        $locationStock = $locationStock->real_stock;
                    }
                }
            } else {
                $locationStock = $totalStock;
            }
        }

        $discount = true;
        if ($this->pivot->menu->period->id == 7) {
            $discount = false;
        }

        if ($this->pivot->menu->period->id == 8) {
            $discount = false;
        }
        if ($this->pivot->menu->period->id == 9) {
            $discount = false;
        }
        if ($this->pivot->menu->period->id == 10) {
            $discount = false;
        }

        if ($this->pivot->menu->period->id == 4) {
            $discount = false;
        }

        $product_title = $this->getTranslation('title', $lang);
        $supplierName = count($this->suppliers) > 0 ? $this->suppliers[0]->getTranslation('name', $lang) : 'ECBento';
        if ($this->pivot->menu->period->id == '15' && !in_array($supplierName, ['Green Monday'])) {
            $supplierName = '';
        }
        
        if ($location == 54) {
            if ($lang != 'en') {
                $product_title = str_replace(' ', '', $product_title);
            }
            // $thisSupplier = count($this->suppliers) > 0 ? $this->suppliers[0]->code : 'ECBento';
           if($this->pivot->menu->period->id == 2){
                if ($lang == 'en') {
                    $product_title = $product_title . ' *included drink';
                } else {
                    $product_title = $product_title . ' *附送飲品';
                }
           }
        } else {
            $product_title . ' - ' . (($this->pivot->menu->alert_text_active == 1) ? $this->pivot->menu->getTranslation('alert_text', $lang) : '');
        }
        // dd('/storage/'.$this->media->file_path);
       
        try {
            // dd($this->media->file_path);
            // if (!Storage::disk('local')->exists('public/products/'.$this->code.'.jpg')) {
            //     $img = Image::make(storage_path('app/public/'.$this->media->file_path));
            //     $img->fit(500, 500, function ($constraint) {
            //         $constraint->upsize();
            //     });     
            //     // $img->crop(500, 500, 0, 0);
            //     $img->save(storage_path('app/public/products/'.$this->code.'.jpg'));
            //     $cropedImage = env('APP_URL') . '/' . ('storage/products/'.$this->code.'.jpg');
            // } else {
            //     $cropedImage = env('APP_URL') . '/' . ('storage/products/'.$this->code.'.jpg');
            // }
            $cropedImage = route('images.product',['slug'=>$this->slug]).'?v='.date('YmdH');
        } catch (\Throwable $th) {
            $cropedImage = $this->image_file;
        }
        
        $data = [
            'id' => $this->pivot->id,
            'period' => $this->pivot->menu->period->getTranslation('title', $lang),
            'period_id' => $this->pivot->menu->period->id,
            'preorder' => ($request->date . ' ' . $period >= date('Y-m-d H:i:s')) ? true : false,
            'product_id' => $this->skus->first()->id,
            'parent_id' => $this->id,
            // 'subtitle' => count($this->suppliers) > 0 ? $this->suppliers[0]->getTranslation('name', $lang) : 'ECBento', //REMARK: 可能好多個brand
            'subtitle' => $supplierName, //REMARK: 可能好多個brand
            'title' => $product_title,
            'description' => $this->getTranslation('description', $lang),
            // 'image' => $this->image,
            'recommended' => 1,
            'categories' => $this->tags->first() ? $this->tags->first()->getTranslations('name') : ['en' => 'chinese', 'zh-hk' => '中式', 'zh-cn' => '中式'],
            'image' => $cropedImage,
            'on_sale' => $this->on_sale,
            'price' => $locationPrice, //REMARK: Update by different location
            'stock' => $locationStock, //REMARK: Update by different location
            // 'rating' => $this->rating,
            // 'review_count' => $this->review_count,
            // 'preset_buffer' => $this->pivot->preset_buffer,
            'ingredients' => [$this->getTranslation('description', $lang)],
            // 'tags' => ['egg','meat','chinese'],
            'tags' => $this->tags->map(function ($item) use ($lang) {
                return $item->getTranslation('name', $lang);
            }),
            'discount' => $discount,
            // 'tagsWithString' => implode(',', $this->tags->pluck('name')->toArray()),
        ];
        $data['user_cart'] = 0;

        if ($token = JWTAuth::getToken()) {
            $user = JWTAuth::parseToken()->authenticate();
            // dd($user);
            if ($user) {
                $userCart = $user->cartItem()->where('menu_product_id', $this->pivot->id)->first();
                if ($userCart) {
                    $data['user_cart'] = $userCart->quantity;
                }
            }
        }


        if (isset($request->date)) {
            $data['menu_date'] = $request->date;
            $data['id'] = $this->pivot->id . '_' . $request->date;
        } else {
            // \Log::info('menu_date '.json_encode($this->pivot->menu));
            $data['menu_date'] = date('Y-m-d', strtotime($this->pivot->menu->menu_date));
            $data['id'] = $this->pivot->id . '_' . $data['menu_date'];
        }

        return $data;
    }
}
