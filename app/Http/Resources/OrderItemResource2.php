<?php

namespace App\Http\Resources;

use App\Http\Api\V1\Model\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource2 extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // $status = 'Ordered';

        if(isset($request->language)){
            $supportLanguage = array("zh-HK", "zh-CN", "en", "zh-hk","zh-cn");
            if (!in_array($request->language, $supportLanguage)) {
                $lang = 'en';
            } else {
                $lang = strtolower($request->language);
            }
        } else {
            $lang = 'en';
        }


        $expired = [
            'zh-hk' => '已過期',
            'zh-cn' => '已过期',
            'en' => 'Expired',
        ];
        $feedback = [
            'zh-hk' => '評價',
            'zh-cn' => '评价',
            'en' => 'Feedback',
        ];

        $paid = [
            'zh-hk' => '已支付',
            'zh-cn' => '已支付',
            'en' => 'Paid',
        ];
        
        $ordered = [
            'zh-hk' => '未支付',
            'zh-cn' => '未支付',
            'en' => 'Unpaid',
        ];

        $picked = [
            'zh-hk' => '已提取',
            'zh-cn' => '已提取',
            'en' => 'Picked',
        ];
        
        $cancel = [
            'zh-hk' => '已取消',
            'zh-cn' => '已取消',
            'en' => 'Cancelled',
        ];
        
        $fail = [
            'zh-hk' => '支付失敗',
            'zh-cn' => '支付失敗',
            'en' => 'Payment Failed',
        ];
       
        $pending = [
            'zh-hk' => '待確認',
            'zh-cn' => '待确认',
            'en' => 'Pending',
        ];
        $delivering = [
            'zh-hk' => '運送中',
            'zh-cn' => '運送中',
            'en' => 'Delivering',
        ];
        $preparing = [
            'zh-hk' => '準備中',
            'zh-cn' => '準備中',
            'en' => 'Preparing',
        ];
        $pickup = [
            'zh-hk' => '待提取',
            'zh-cn' => '待提取',
            'en' => 'To pick-up',
        ];

        $payment_status = '';
        $status = $this->status;
        $shipstatus = $this->ship_status;
        // $status = $this->order->payment_status;

        if($status == 'pending'){
            $status = $pending[$lang];
            $payment_status = 'Cancel Order';
            $shipstatus = 'cancel_order';
        }
        
        if($status == 'picked'){
            $status = $picked[$lang];
            $payment_status = $feedback[$lang];
        }
      
        if($status == 'cancelled' || $status == 'failed'){
            $status = $cancel[$lang];
            $payment_status = '';
        }

        if($status == 'ready'){
            $status = $pickup[$lang];
            $payment_status = '';
        }
      
        if($status == 'request_refund'){
            $status = 'Requested';
            $payment_status = '';
            $shipstatus = 'request_refund';
        }

        if($status == 'paid'){
            if($shipstatus=='picked'){
                $status = $picked[$lang];
                $payment_status = $feedback[$lang];
                $shipstatus = 'feedback';
            } else {
                $status = $preparing[$lang];
                $payment_status = '';
            }
            if($shipstatus == 'ready'){
                $status = $pickup[$lang];
                $payment_status = '';
            }
            if($shipstatus == 'cancelled'){
                $status = $cancel[$lang];
                $payment_status = '';
            }
            if($shipstatus == 'expired'){
                $status = $expired[$lang];
                $payment_status = '';
            }
        }

        if($status == 'delivering'){
            $status = $delivering[$lang];
            $payment_status = '';
        }

       
        return [
            'bento_id' => $this->id,
            'date'  => date('Y-m-d',strtotime($this->extraction_start)),
            // 'image' => (!$this->product->image)?$this->product->getTranslation('image', 'en'):$this->product->image,
            'image' => (!$this->product->image_file)?$this->product->image_file:$this->product->image_file,
            'title' => $this->product->getTranslation('title', $lang),
            'subtitle' => $this->product->supplier?$this->product->supplier->name:'ECBento', //TODO: get supplier name : $this->product->suppliers[0]->name
            'price' => $this->price,
            'qty'   => $this->quantity,
            'period' => 'lunch',
            'status' => $status,
            'location' => Store::find($this->store_id)->getTranslation('name',$this->user->language),
            'payment_status' => ucfirst($payment_status),  //Request Refund, Feedback, Cancel Order, if payment_status cancelled -> this empty too,
            'action' => [
                'title'=>$payment_status,
                'value'=>$shipstatus
            ]
        ];
    }
}
