<?php
	
namespace App\Classes\Payment;

use App\User;
use App\Order;
use App\OrderPayment;
use App\Http\Api\V1\Model\Payment;

class Paypal {

    // private $payment;

    // public function __construct(Payment $payment)
    // {
    //     $this->payment = $payment;
    // }

    public static function purchase(Order $order, int $testMode)
    {
        $curlPost['cmd']             = '_cart';
        $curlPost['upload']        = '1';
        $curlPost['no_shipping']   = '1'; // 0 or 1
        $curlPost['currency_code'] = 'HKD';

        $number = 1;
        $items = $order->items;

        if(isset($items)){
            foreach($items as $number => $item){
                $number = $number+1;
                $curlPost['item_name_'.$number] = $item->product->title;//product title
                $curlPost['item_number_'.$number] = $item->product_sku_id; //product id
                $curlPost['quantity_'.$number] = $item->quantity; //qty
                // $curlPost['amount_'.$number] = $item->price * $item->quantity; //prices
                $curlPost['amount_'.$number] = $item->price; //prices
            }
        }
        
        if(count($order->charges)>0) {
            $total_discount = abs( $order->charges->where('value','<=',0)->sum('value') );
            $curlPost['discount_amount_cart'] = $total_discount;
        }
    
        $curlPost['business']      = 'info@ecbento.com'; //收費
        $curlPost['notify_url']    = route('payment.notify',['order'=>$order->id,'payment'=>'paypal']);
        $curlPost['return']        = route('payment.return',['order'=>$order->id,'payment'=>'paypal']);
        $curlPost['invoice']       = $order->no;
        // $curlPost['custom']     = $coupon;
        $curlPost['test_ipn']      =  1;
        \Log::debug('calling payal');
        \Log::debug($curlPost);
        if($testMode){
            header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . http_build_query($curlPost, '', '&'));
        } else {
            header('Location: https://www.paypal.com/cgi-bin/webscr?' . http_build_query($curlPost, '', '&'));
        }

        // return response()->json([
        //     'code' => '0000',
        //     'method' => 'paypal',
        //     'data' => $curlPost,
        // ]); 
    }

    public function notify(Request $request,$user_id,$order_id){
        // $ipn_post_data = $request->all();
        // // file_put_contents('/payment.txt', serialize($ipn_post_data));

        // // // Choose url
        // // if (array_key_exists('test_ipn', $ipn_post_data) && 1 === (int) $ipn_post_data['test_ipn']) {
        // //     $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        // // } else {
        //     $url = 'https://www.paypal.com/cgi-bin/webscr';
        // // }

        // // Set up request to PayPal
        // $request = curl_init();
        // curl_setopt_array($request, array
        //     (
        //         CURLOPT_URL            => $url,
        //         CURLOPT_POST           => true,
        //         CURLOPT_POSTFIELDS     => http_build_query(array('cmd' => '_notify-validate') + $ipn_post_data),
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_HEADER         => false,
        //         CURLOPT_SSL_VERIFYPEER => true,
        //     ));

        // // Execute request and get response and status code
        // $response = curl_exec($request);
        // $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

        // // Close connection
        // curl_close($request);

        // // if($status == 200 && $response == 'VERIFIED'){
        //     DB::table('datafeed')->insert(
        //         ['user_id'=>$user_id,'method'=>'paypal','datafeed' => json_encode($ipn_post_data), 'created_at' => date('Y-m-d H:i:s')]
        //     );
            
        //     // Check repeat datafeed
        //     $order_chk_completed = Order::find($order_id);
        //     if($order_chk_completed->status != 'paid') {
        //         // if(($ipn_post_data['payment_status'] == 'Completed' && $ipn_post_data['payer_status']=='verified')) {
        //         if($ipn_post_data['payment_status'] == 'Completed') {
        //             $order = Order::find($order_id);
        //             $order->status = 'paid';
        //             $order->save();
                    

        //             if($ipn_post_data['custom'] != null) {
        //                 $coupon = $ipn_post_data['custom'];
        //                 $used_coupon = Coupon::where('code', $coupon)->first();
        //                 $used_coupon->use_count = $used_coupon->use_count+1;
        //                 $used_coupon->save();

        //                 $user_used_coupon = UserCoupon::where('user_id', $user_id)->where('status','available')->where('expired_at','>=',date('Y-m-d H:i:s'))->where('coupon_id', $used_coupon->id)->orderBy('id','desc')->first();
        //                 $user_used_coupon->use_count = $user_used_coupon->use_count+1;
        //                 if( $user_used_coupon->use_count ==  $user_used_coupon->max_use ) {
        //                     $user_used_coupon->status = 'used';
        //                 }
        //                 $user_used_coupon->save(); 
        //             }
        //             $this->checkout_sms($user_id, $order_id);
        //             $this->reduce_stock($user_id);
                   
        //         }   
        //     }
        //     //update order status to completed
        // // }
    }

}