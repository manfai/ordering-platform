<?php
	
namespace App\Classes\Payment;

use App\User;
use App\Order;
use App\OrderPayment;
use App\Http\Api\V1\Model\Payment;
// use Request;

class MPGS {

    // private $payment;

    // public function __construct(Payment $payment)
    // {
    //     $this->payment = $payment;
    // }

    public static function purchase(Order $order, int $testMode)
    {

        if($testMode){
            $url = 'https://test-gateway.mastercard.com/api/rest/version/54/merchant/010826285/';
        } else {
            $url = 'https://ap-gateway.mastercard.com/api/rest/version/54/merchant/010826285/';
        }
        $successUrl = route('payment.return',['order'=>$order->id,'payment'=>$order->payment_method]);
        $failUrl = route('payment.cancel',['order'=>$order->id,'payment'=>$order->payment_method]);
        $cancelUrl = route('payment.cancel',['order'=>$order->id,'payment'=>$order->payment_method]);

        $token = '123123';
        $cvc = '123123';

        $extra = $order->extra;
        if($extra){
            $token = $extra['token'];
            $cvc = $extra['cvc'];
            logging('user payment data',$extra);
        }
        
        $payData = [
            "apiOperation" => "PAY",
            "sourceOfFunds"=> [
                "token"=> $token, 
                "provided" => [
                    "card" => [
                        "securityCode" => $cvc
                    ]
                ],
                "type"=> "CARD"
            ],
            
            "order" => [
                "amount" => $order->real_amount,
                "currency" => "HKD"
            ]
        ];
        // dd($payData);
        // \Log::channel('payment')->info($payData);
        $transactionId = $order->no.$order->user_id;
        // dd($transactionId);
        $payUrl = $url.'order/'.$order->no."//transaction//".$transactionId;
        $payCh = curl_init($payUrl);
        curl_setopt($payCh, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($payCh, CURLOPT_USERPWD, "merchant.010826285:661362d9555a6d13868b2e02d5be13e1"); //Your credentials goes here
        curl_setopt($payCh, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($payCh, CURLOPT_POST, true);
        curl_setopt($payCh, CURLOPT_POSTFIELDS, json_encode($payData));
        curl_setopt($payCh, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); 
        $payResponse = curl_exec($payCh);
        logging('MPGs response data',$payResponse);
        $payResponse = json_decode($payResponse,true);
        // dd($payResponse);
        if($payResponse['result']=='SUCCESS'){
            $order->update([
                'payment_status' => 'paid',
                'closed' => 1,
            ]);
            $order->items()->update([
                'status' => 'paid',
            ]);
            // return redirect()->route('payment.return',['order'=>$order->id,'payment'=>'mastercard'])->with($payResponse);
            // $request = Request::create(route('payment.return',['order'=>$order->id,'payment'=>'mastercard']), 'POST', ['body' => $payResponse]);
            return redirect()->action('\App\Http\Api\V1\Controllers\PaymentController@return',['mpgs'=>$payResponse,'order'=>$order->id,'payment'=>$order->payment_method]);
        }  else {
            return redirect()->action('\App\Http\Api\V1\Controllers\PaymentController@return',['mpgs'=>$payResponse,'order'=>$order->id,'payment'=>$order->payment_method]);
            return redirect()->route('payment.cancel',['order'=>$order->id,'payment'=>$order->payment_method])->with($payResponse);
        }
        
        return [
            'success'=>true,
            'data'=>$payResponse
        ];
    }

    public static function validation(array $cardInfo) {
        
        $testMode = 0;

        if($testMode){
            $url = 'https://test-gateway.mastercard.com/api/rest/version/54/merchant/010826285/token';
        } else {
            $url = 'https://ap-gateway.mastercard.com/api/rest/version/54/merchant/010826285/token';
        }
  
        $cardInfo['card_no'] = str_replace(' ','',$cardInfo['card_no']);
        $cardInfo['exp_date'] = str_replace('/','',$cardInfo['exp_date']);
        $expiryMonth = substr($cardInfo['exp_date'], 0, 2);
        $expiryYear = substr($cardInfo['exp_date'], 2, 3);
        // dd($expiryMonth);
        $data = [
            "sourceOfFunds" => [
                "provided" => [
                    "card" => [
                        "expiry"=>[
                            "month"=> $expiryMonth,
                            "year"=> $expiryYear
                        ],
                        "number"=>$cardInfo['card_no']
                    ]
                ],
                "type"=>"CARD"
            ]
        ];
     
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "merchant.010826285:661362d9555a6d13868b2e02d5be13e1"); //Your credentials goes here
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); 
        $response = curl_exec($ch);
        

        \Log::channel('payment')->info('START OF MASTERCAR PAYMENT');
        \Log::channel('payment')->info($url);
        \Log::channel('payment')->info($cardInfo);
        \Log::channel('payment')->info($data);
        \Log::channel('payment')->info($response);
        \Log::channel('payment')->info('END OF MASTERCAR PAYMENT');

        $response = json_decode($response,true);
        logging('mpgs validation result', $response);
        if(!$response){
            //REMARK: if null
            $response = [
                'result'=>'FAILED',
                'error' => [
                    'explanation' => 'Ooops...'
                ]
            ];
        }
        return $response;

    }

}