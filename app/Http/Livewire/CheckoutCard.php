<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\UserPayment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Omnipay\Common\CreditCard;

class CheckoutCard extends Component
{
    public $cartItems;
    public $checkingOut = false;
    public $payments, $coupons, $selected_coupon_price = 0;
    public $selected_payment, $selected_coupon, $selected_shipping = null, $selected_card = null;
    public $number,$exp_month,$exp_year,$cvc;

    protected $listeners = [
        'payment_method' => 'paymentMethod',
        'coupon_choosed' => 'couponChoosed',
        'shipping_choosed' => 'shippingChoosed',
        'checkout' => 'checkoutNow',
    ];

    public function checkoutNow()
    {
        $this->emit('$refresh');
        $this->checkingOut = true;
        $this->mount();
    }
   
    public function updateCardPayment($id)
    {
        $this->selected_card = $id;
        $this->emit('$refresh');
    }

    public function paymentMethod($payment)
    {
        $this->selected_payment = $payment;
    }

    public function couponChoosed(Coupon $coupon)
    {
        $this->selected_coupon = $coupon->id;
        $this->selected_coupon_price = $coupon->value;
    }
    
    public function shippingChoosed($method)
    {
        $this->selected_shipping = $method;
    }

    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
        $this->emit('system_message', 'Item Deleted');
        $this->emit('$refresh');
    }

    public function mount()
    {
        // session()->flash('message', 'Post successfully updated.');
        $this->cartItems = Auth::user()->cartItem()->get();
        $this->payments  = Payment::whereIn('id', [5])->get();
        $this->coupons   = Coupon::where('active', 1)->where('value', '>', 0)->inRandomOrder()->limit(10)->get();
    }

    public function submit()
    {
        $customerReference = null;
        try {
            if($this->selected_payment=='new'){
                $payment = Payment::find(5);
    
                $gateway = \Omnipay\Omnipay::create('Stripe');
                $gateway->setApiKey('sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0');
                $gateway->setTestMode(true);
                
                $token = $gateway->createToken([
                    'card' => [
                        'number' => $this->number,
                        'expiryMonth' => $this->exp_month,
                        'expiryYear' => $this->exp_year,
                        'cvc' => $this->cvc,
                    ],
                ])->send();
                $token = $token->getData();

                $customers = $gateway->createCustomer([
                    'description' => 'My First Test Customer (created for API docs)',
                    'email' => auth()->user()->email,
                    'name' => auth()->user()->name,
                    'token' =>$token['id'],
                    'metadata' => auth()->user()->toArray()
                ])->send();
                $customer = $customers->getData();

                auth()->user()->payments()->create([
                    'payment_id' => '5',
                    'brand'  => 'STRIPE',
                    'name'   => substr($this->number, 0, 6).'xxxxxx'.substr($this->number, -4),
                    'key'    => 'customer',
                    'value'  => $customer['id'],
                    'remark' => $customer
                ]);
                $customerReference = $customer['id'];

            } else
            {
                $payment = Payment::where('code', $this->selected_payment)->first();
            }

            switch ($payment->provider) {
                case 'paypal':
                    $client = new \GuzzleHttp\Client();
                    $res = $client->get('https://air.ecbneto.com/api/checkout/pay', [
                        'payment_id'     =>  '',
                        'coupon_id'      =>  '',
                        'language'       =>  '',
                        'card_id'        =>  '',
                        'card_cvc'       =>  '',
                        'remark'         =>  '',
                        'full_address'   =>  '',
                    ]);
                    $result = $res->getBody();
                    break;
    
                case 'stripe':
                    
                    // dd($this->selected_card);

                    if(!$customerReference){
                       if($this->selected_card){
                            $customerReference = UserPayment::find($this->selected_card)->value;
                       } else {
                            $userpayment = auth()->user()->payments()->where('brand','STRIPE')->orderBy('created_at','desc')->first();
                            if($userpayment){
                                $customerReference = $userpayment->value;
                            }
                       }
                        // dd($customerReference);
                    }
                    
                    $gateway = \Omnipay\Omnipay::create('Stripe');
                    $gateway->setApiKey('sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0');
                    $gateway->setTestMode(true);
                  
                  

                    // $gateway->createSource(
                    //     [
                    //         $customer['id'],
                    //         ['source' => 'tok_visa']
                    //     ]
                    // );
                    // dd($customers);
    
                    $amount = ($this->cartItems->sum('amount') - $this->selected_coupon_price) <=0 ? 0 : $this->cartItems->sum('amount') - $this->selected_coupon_price;
                    $response = $gateway->purchase(array(
                        'amount' => $amount, 'currency' => 'HKD',
                        'customerReference' => $customerReference,
                        'receipt_email' => auth()->user()->email,
                    
                    ))->send();
    
                    if ($response->isRedirect()) {
                        // redirect to offsite payment gateway
                        $response->redirect();
                    } elseif ($response->isSuccessful()) {
                        // payment was successful: update database
                        // dd($response);
                        $this->checkingOut = false;
                        session()->flash('message', 'Order successfully created.');
                    } else {
                        // payment failed: display message to customer
                        session()->flash('message', $response->getMessage());
                    }
    
                    
                    $this->emit('$refresh');
                    // dd('redirect to mpgs');
                    break;
    
                case 'paydollar':
                    dd('redirect to asiapay');
                    break;
                case 'mpgs':
                    dd('redirect to asiapay');
                    break;
            }
        } catch (\Throwable $th) {
            session()->flash('message', $th->getMessage());
            $this->emit('$refresh');  
        }
    }

    public function render()
    {
        return view('livewire.checkout-card');
    }
}
