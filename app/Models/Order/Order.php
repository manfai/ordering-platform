<?php

namespace App\Models\Order;

use App\Classes\Offer;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED = 'failed';

    const SHIP_STATUS_PENDING = 'pending';
    const SHIP_STATUS_DELIVERED = 'delivered';
    const SHIP_STATUS_RECEIVED = 'received';

    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING    => '未退款',
        self::REFUND_STATUS_APPLIED    => '已申请退款',
        self::REFUND_STATUS_PROCESSING => '退款中',
        self::REFUND_STATUS_SUCCESS    => '退款成功',
        self::REFUND_STATUS_FAILED     => '退款失败',
    ];

    public static $shipStatusMap = [
        self::SHIP_STATUS_PENDING   => '未發貨',
        self::SHIP_STATUS_DELIVERED => '已發貨',
        self::SHIP_STATUS_RECEIVED  => '已收貨',
    ];

    public $guarded = [];

    protected $casts = [
        'remark' => 'array',
        'paid_at' => 'datetime',
        'ship_data' => 'json',
        'extra' => 'json',
    ];

    protected $dates = [
        'paid_at',
    ];

    protected static $logAttributes = [
        'remark',
        'paid_at',
        'ship_data',
        'extra',
    ];

    protected static function boot()
    {
        parent::boot();
        // 監聽模型創建事件，在寫入數據庫之前觸發
        static::updated(function ($model) {
            try {
                if ($model->payment_status == 'paid') {
                    $sms_data['phone_no'] = $model->user->phone_no;
                    $sms_data['user_define_no'] = $model->user->phone_no;
                    $content = Message::find(1)->content;
                    $content = str_replace('[code]', $model->extraction_code, $content);
                    $sms_data['message'] = $content;
                    send_sms($sms_data);
                }
            } catch (\Throwable $th) {
                \Log::debug('send sms error');
                \Log::debug($th);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user()->name;
    }

    public function itemsBySort($sortBy)
    {
        // dd($sortBy);
        return $this->hasMany(OrderItem::class)->orderBy($sortBy, 'desc');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function charges()
    {
        return $this->hasMany(OrderCharge::class)->select('remark', 'value');
    }

    public function discounts()
    {
        return $this->hasMany(OrderDiscount::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function refunds()
    {
        return $this->hasMany(OrderRefund::class);
    }

    public function logs()
    {
        return $this->hasMany(OrderLog::class);
    }

    public function getExtractionCodeAttribute()
    {
        try {
            if(!$this->extraction_code){
                return $this->items->first()->extraction_code;
            } else {
                return $this->extraction_code;
            }
        } catch (\Throwable $th) {
            if($this->items->first()){
                return $this->items->first()->extraction_code;
            } else {
                return '';
            }
            // dd($this->items->first());

        }
    }

    public function setClosedAttribute($value)
    {
        // if ($this->id > 200000) {

        //     $user = $this->user;
        //     // dd($user->cartItem->delete());
        //     $userCart = CartItem::where([
        //         'user_id' => $user->id
        //     ])->get();

        //     \Log::debug(json_encode($userCart));

        //     //add sold no.
        //     \Log::debug('add sold value');
        //     foreach ($userCart as $cartItem) {
        //         $menuStock = MenuLocationStock::where([
        //             'menu_product_id' => $cartItem->menu_product_id,
        //             'store_id' => $cartItem->store_id,
        //         ])->first();

        //         $period = Period::find($cartItem->period_id);
        //         $periodCode = $period->code;
        //         if ($period) {
        //             $period = $period->preorder_end;
        //         } else {
        //             $period = '23:59:59';
        //         }

        //         // $menu_date = $menuStock->menuProduct->menu->menu_date;
        //         $menu_date = $cartItem->menu_date;
        //         $type = 'normal';

        //         // \Log::debug('menudate:'.$menu_date);

        //         // if($cartItem->menu_date.' '.$period >= date('Y-m-d H:i:s')){
        //         $preorder = date('Y-m-d', strtotime($menu_date)) . ' ' . $period;
        //         $now = date('Y-m-d H:i:s');
        //         \Log::debug('cart now:' . $preorder);
        //         if (date('Y-m-d H:i:s', strtotime($now)) <= date('Y-m-d H:i:s', strtotime($preorder))) {
        //             $type = 'preorder';
        //         } else if (date('Y-m-d') == $menu_date) {
        //             if ($cartItem->period_id >= 8) {
        //                 $type = 'normal';
        //             } else {
        //                 if (date('H:i') < date('H:i', strtotime('10:01'))) {
        //                     $type = 'preorder';
        //                 } else {
        //                     $type = 'normal';
        //                 }
        //             }
        //         } else {
        //             $type = 'normal';
        //         }

        //         \Log::debug('add sold value only buffur');

        //         if ($type == 'normal') { //buffur
        //             $menuStock->update([
        //                 'sold' => $menuStock->sold + $cartItem->quantity
        //             ]);
        //             \Log::debug('added #' . $cartItem->menu_product_id . ' sold value:' . $cartItem->quantity);
        //         }

        //         \Log::debug('sold testing');
        //         $paymentStatus = '已建立';
        //         if ($this->payment_status == 'paid') {
        //             $paymentStatus = '已支付';
        //         }
        //         if ($type == 'preorder') {
        //             remindAdmin('新' . ucfirst($type) . ucfirst($periodCode) . '訂單' . date('Y-m-d', strtotime($cartItem->menu_date)) . ': #' . Product::find($cartItem->product_id)->title . 'x' . $cartItem->quantity . ' ' . $paymentStatus, [10126, 10128, 10711]);
        //         }
        //     }

        //     CartItem::where([
        //         'user_id' => $user->id
        //     ])->delete();

        //     $userSuggestion = UserSuggestion::where([
        //         'user_id' => $user->id,
        //     ])->delete();

        //     // if( $value == 1 && $this->attributes['payment_status'] == 'paid'){
        //     // $data['phone_no'] = $user->phone_no;
        //     // $data['user_define_no'] = $user->phone_no;
        //     // $items = OrderItem::where('order_id',$this->attributes['id'])->get()->pluck('menu_date');
        //     // \Log::debug($data);
        //     // \Log::debug($items);
        //     // \Log::debug('sending');
        //     // $content = Message::find(1)->content;
        //     // $content = str_replace('[code]',$this->attributes['extraction_code'],$content);
        //     // $data['message'] = $content;
        //     // $sent = send_sms($data);   

        //     // }

        // }
        // $usercoupons = $this->discounts()->where(['discount_type' => 'App\UserCoupon'])->get();
        // foreach ($usercoupons as $key => $usercoupon) {
        //     $coupon = UserCoupon::find($usercoupon->discount_id);
        //     if ($coupon) {
        //         Offer::coupon()->use($coupon);
        //     }
        // }
        // // ->create([
        // //     'discount_type'=>'App\UserCoupon',
        // //     'discount_id'=>$coupon->id,
        // //     'data' => json_encode($coupon),
        // //     'value' => $couponValue,
        // //     'remark' => NULL
        // // ]);
        // $this->attributes['closed'] = $value;
    }

    public function setPaymentStatusAttribute($value)
    {
        $this->items()->update([
            'status' => $value
        ]);
        $this->attributes['payment_status'] = $value;
    }

    public function getRealAmountAttribute($value)
    {
        return ($value < 0) ? 0 : $value;
    }

    public function device()
    {
        $this->hasOne(DeviceOrder::class);
    }

    public static function findAvailableNo()
    {
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            // $no = date('YmdHis').str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
            $no = date('Ymd') . str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
            \Log::warning('Order No. already exist -> ' . $no);
        }
        \Log::warning('Order No. Failed');
        return false;
    }
}
