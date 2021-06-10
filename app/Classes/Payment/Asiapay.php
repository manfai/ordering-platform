<?php
	
namespace App\Classes\Payment;

use App\User;
use App\Order;
use App\OrderPayment;

class Asiapay {

    // private $payment;

    // public function __construct($payment)
    // {
    //     $this->payment = $payment;
    // }

    public static function purchase(Order $order, int $testMode)
    {
        // dd($order);
        
        $merchantId = '88619263';
        $currCode = '344';
        $payType = 'N';
        $successUrl = route('payment.return',['order'=>$order->id,'payment'=>'asiapay']);
        $failUrl = route('payment.cancel',['order'=>$order->id,'payment'=>'asiapay']);
        $cancelUrl = route('payment.cancel',['order'=>$order->id,'payment'=>'asiapay']);
        $secureHash = sha1($merchantId. '|' .$order->no. '|' .$currCode. '|' .$order->real_amount. '|' .$payType. '|' .'bZe67kcltBHsrmW9EvnnscrdMuNc1HPU');

        $lang = 'C';
        $html = '<form name="payFormCcard" id="payFormCcard" method="post" action="https://www.paydollar.com/b2c2/eng/payment/payForm.jsp">';
        $html .= '<input type="hidden" name="merchantId" value="'.$merchantId.'">';
        $html .= '<input type="hidden" name="orderRef" value="'.$order->no.'">';
        $html .= '<input type="hidden" name="amount" value="'.$order->real_amount.'" >';
        $html .= '<input type="hidden" name="currCode" value="'.$currCode.'" ><input type="hidden" name="mpsMode" value="NIL" >';
        $html .= '<input type="hidden" name="successUrl" value="'.$successUrl.'">';
        $html .= '<input type="hidden" name="failUrl" value="'.$failUrl.'">';
        $html .= '<input type="hidden" name="cancelUrl" value="'.$cancelUrl.'">';
        $html .= '<input type="hidden" name="payType" value="'.$payType.'">';
        $html .= '<input type="hidden" name="lang" value="'.$lang.'">';
        $html .= '<input type="hidden" name="payMethod" value="ALIPAYHKONL">';
        if(isset($coupon)) {
            $c = Coupon::where('code', $coupon)->first(); 
            $html .= '<input type="hidden" name="promotion" value="T">';
            $html .= '<input type="hidden" name="promotionCode" value="'.$c->code.'">';
            $html .= '<input type="hidden" name="promotionOriginalAmt" value="'.$c->value.'">';
        }
        $html .= '<input type="hidden" name="secureHash" value="'.$secureHash.'">';
        $html .= '</form>';
        $html .= '<script> document.payFormCcard.submit(); </script>';

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, 'https://www.paydollar.com/b2c2/eng/payment/payForm.jsp');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // // curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
        // $data = curl_exec($ch);
        // curl_close($ch);
        // // echo "<pre>";
        echo html_entity_decode($html);
        // echo "</pre>";
        // return file_get_contents( htmlentities($data));

        // logging('asiapay curl',$ch);
        // logging('asiapay data',$data);
        // return $data;

    }

    public static function generatePaymentSecureHash($merchantId, $merchantReferenceNumber, $currencyCode, $amount, $paymentType, $secureHashSecret) {
		$buffer = $merchantId . '|' . $merchantReferenceNumber . '|' . $currencyCode . '|' . $amount . '|' . $paymentType . '|' . $secureHashSecret;
		//echo $buffer;
		return sha1($buffer);

    }

    // $lang = 'E';
    // if($locale == 'zh-Hant') {
    //     $lang = 'C';
    // } elseif($locale == 'zh') {
    //     $lang = 'X';
    // }
    // $payMethod = 'ALIPAYHKONL';
    // $merchantId = '88619263';
    // $currCode = '344';
    // $payType = 'N';
    // $order = Order::find($order_id);
    // $secureHashSecret='bZe67kcltBHsrmW9EvnnscrdMuNc1HPU';//offered by paydollar
    // $secureHash=$this->generatePaymentSecureHash($merchantId, $order->order_code, $currCode, $order->real_paid, $payType, $secureHashSecret);

    // $successUrl = "https://ecbento.com/member/order/".$order->order_code;
    // $failUrl = "https://ecbento.com/";
    // $cancelUrl = "https://ecbento.com/";
    // $user = User::find($order->user_id);
    // if($user->merchant->label == 'hkland') {
    //     \Log::debug($user->merchant->label);
    //     $successUrl = "https://hkland.ecbento.com/member/order/".$order->order_code;
    //     $failUrl = "https://hkland.ecbento.com/";
    //     $cancelUrl = "https://hkland.ecbento.com/";
    // }
    // \Log::debug($successUrl);
    // $html = '<form name="payFormCcard" id="payFormCcard" method="post" action="https://www.paydollar.com/b2c2/eng/payment/payForm.jsp">';
    // $html .= '<input type="hidden" name="merchantId" value="'.$merchantId.'">';
    // $html .= '<input type="hidden" name="orderRef" value="'.$order->order_code.'">';
    // $html .= '<input type="hidden" name="amount" value="'.$order->real_paid.'" >';
    // $html .= '<input type="hidden" name="currCode" value="'.$currCode.'" ><input type="hidden" name="mpsMode" value="NIL" >';
    // $html .= '<input type="hidden" name="successUrl" value="'.$successUrl.'">';
    // $html .= '<input type="hidden" name="failUrl" value="'.$failUrl.'">';
    // $html .= '<input type="hidden" name="cancelUrl" value="'.$cancelUrl.'">';
    // $html .= '<input type="hidden" name="payType" value="'.$payType.'">';
    // $html .= '<input type="hidden" name="lang" value="'.$lang.'">';
    // $html .= '<input type="hidden" name="payMethod" value="'.$order->pay_type.'">';
    // if(isset($coupon)) {
    //     $c = Coupon::where('code', $coupon)->first(); 
    //     $html .= '<input type="hidden" name="promotion" value="T">';
    //     $html .= '<input type="hidden" name="promotionCode" value="'.$c->code.'">';
    //     $html .= '<input type="hidden" name="promotionOriginalAmt" value="'.$c->value.'">';
    // }
    // $html .= '<input type="hidden" name="secureHash" value="'.$secureHash.'">';
    // $html .= '</form>';
    // $html .= '<script> document.payFormCcard.submit(); </script>';

    
    // \Log::channel('payment')->info('--- Start of Paydollar ---');
    // \Log::channel('payment')->info($html);
    // \Log::channel('payment')->info('--- End of Paydollar ---');

    // // $html .= '<script>document.getElementById("payFormCcard").submit();</script>';
    // return response()->json([
    //     'code' => '0000',
    //     'method' => 'paydollar',
    //     'data' => $html,
    // ]);  
}