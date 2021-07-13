<?php
	
namespace App\Classes;

use App\User;
use App\OrderPayment;
use App\Classes\Payment\MPGS;
use App\Classes\Payment\Paypal;
use App\Classes\Payment\Stripe;
use App\Classes\Payment\Asiapay;
use App\Http\Api\V1\Model\Payment;

class Pay {

    public static function gateway($payment)
    {
       switch ($payment->provider) {
            case 'stripe':
               return new Stripe($payment->id);
               break;
            case 'mpgs':
                return new MPGS($payment->id);
                break;
            case 'paydollar':
                return new Asiapay($payment->id);
                break;
            case 'paypal':
                return new Paypal($payment->id);
                break;
       }
    }

}