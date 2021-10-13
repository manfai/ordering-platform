<?php

namespace App\Http\Livewire;

use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order\Order;
use App\Models\Payment;
use App\Models\Period;
use App\Models\StoreMachine;
use App\Models\UserCoupon;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Omnipay\Common\CreditCard;

class CheckoutCard extends Component
{
    public $cartItems;
    public $checkingOut,$loading = false;
    public $done = false;
    public $procced = 'Proceed to checkout';
    public $payments, $coupons, $selected_coupon_price = 0;
    public $selected_payment, $selected_coupon, $selected_shipping = null, $selected_card = null;
    public $number,$exp_month,$exp_year,$cvc;

    protected $listeners = [
        'payment_method' => 'paymentMethod',
        'coupon_choosed' => 'couponChoosed',
        'shipping_choosed' => 'shippingChoosed',
        'checkout' => 'checkoutNow',
    ];

    protected $rules = [
        'number' => 'required',
        'exp_month' => 'required',
        'exp_year' => 'required',
        'cvc' => 'required',
    ];

    public function checkoutNow()
    {
        $this->emit('$refresh');
        $this->checkingOut = true;
        $this->mount();
    }
   
    public function checkCardDate(){
        if($this->exp_year == date('Y')){
            if($this->exp_month < date('m')){
                return false;
            }
        }
        return true;
    }
  
    
    // public function updateExpMonth(){
    //     $this->checkCardDate();
    // }

    public function updateExpYear(){
        if($this->exp_year == date('Y')){
            if($this->exp_month < date('m')){
                $this->exp_month = null;
            }
        }
    }

    
    public function updateCardPayment($id)
    {
        $this->selected_card = $id;
        if($this->selected_card){
            $this->done = true;
        } else {
            $this->done = false;
        }
        $this->emit('$refresh');
    }

    public function paymentMethod($payment)
    {
        if($payment == 'new'){
            $this->done = true;
        } else {
            if($this->selected_card){
                $this->done = true;
            } else {
                $this->done = false;
            }
        }
        $this->selected_payment = $payment;
    }

    public function couponChoosed(UserCoupon $coupon)
    {
        $this->selected_coupon = $coupon->id;
        $this->selected_coupon_price = $coupon->coupon->value;
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
        return redirect('checkout'); 
    }

    public function mount()
    {
        // session()->flash('message', 'Post successfully updated.');
        $this->cartItems = Auth::user()->cartItem()->get();
        $this->payments  = Payment::whereIn('id', [5])->get();
        // $this->coupons   = Coupon::where('active', 1)->where('value', '>', 0)->inRandomOrder()->limit(10)->get();
        $this->coupons   = Auth::user()->coupons()->where('coupon_id', 68)->get();
    }

    public function createOrder($payment){
        \Log::channel('order')->info('User Email: '.$this->cartItems->first()->user->email);
        \Log::channel('order')->info('Total Order: '.$this->cartItems->count());
        \Log::channel('order')->info('Student Info: '.$this->cartItems->first()->remark);
        $extraction_code = $this->genExctrationCode();
        $total_amount = ($this->cartItems->sum('amount') - $this->selected_coupon_price) <=0 ? 0 : $this->cartItems->sum('amount') - $this->selected_coupon_price;
        $order = Order::create([
            'no' => date('YmdHis') . mt_rand(1000, 9999),
            'platform' => 'app_v2',
            'user_id' => auth()->user()->id,
            'extraction_code' => $extraction_code,
            'total_amount' => $total_amount,
            'real_amount' => $total_amount,
            'payment_method' => $payment->code,
            'product_count' => $this->cartItems->count(),
        ]);

        if (isset($this->address)) {
            if ($this->address !== '') {
                $order->address = $this->address;
                $order->save();
            }
        }
        if (isset($this->remark)) {
            if ($this->remark !== '') {
                $order->remark = $this->remark;
                $order->save();
            }
        }
        foreach ($this->cartItems as $key => $cartItem) {
            $giveback = 0;
            $period = $cartItem->period_id;
            $store = $cartItem->store_id;
            $machine = StoreMachine::where(['store_id' => $store, 'period_id' => $period])->first();
            $period = Period::find($period);
            if (!$period) {
                $period = Period::find(2);
            }
            $itemStore = $cartItem->store_id;
            $itemMachine = $machine ? $machine->machine_id : 1;
            $orderItem = $order->items()->create([
                'product_sku_id' => $cartItem->product_sku_id,
                'product_id' => $cartItem->product_id,
                'store_id' => 57,
                'quantity' => $cartItem->quantity,
                'extraction_code' => $extraction_code,
                'extraction_start' => date('Y-m-d', strtotime($cartItem->menu_date)) . ' ' . $period->start,
                'extraction_expired' => date('Y-m-d', strtotime($cartItem->menu_date)) . ' ' . $period->end,
                'price' => $cartItem->price,
                'extend_time' => 0, //REMARK: this is second!!!!!
                'user_id' => auth()->user()->id,
                'menu_date' => $cartItem->menu_date,
                'period' => $period->code,
                'machine_id' => $machine ? $machine->machine_id : 1,
                'type' => (date('H:i:s') <= $period->preorder_end) ? 'preorder' : 'normal',
                'giveback' => $giveback,
                'remark' => $cartItem->remark
            ]);
            $orderItem->save();

            $orderCharges = $order->charges()->create([
                'value' => $cartItem->amount,
                'remark' => 'Product:' . $cartItem->product_id,
            ]);
            $orderCharges->save();
        }

        $order->update([
            'store_id' => $itemStore,
            'machine_id' => $itemMachine,
        ]);

        \Log::channel('order')->debug($order);
        
        return $order;
    }

    public function submit(Request $request)
    {
        if(!Auth::check()) {
            return redirect(route('login'));
        }
        $customerReference = null;
        $this->procced = 'Pending';
        $this->loading = true;
        // $this->done = false;
        \Log::channel('order')->info('User Start of Create Order');
        try {
            if($this->cartItems->count()>0){

                if($this->selected_payment=='new'){
                    $t = [
                        str_replace(' ','',$this->number),
                        $this->exp_month,
                        $this->exp_year,
                        $this->cvc
                    ];
                    // dd($t);
                    $this->validate();
                    $payment = Payment::find(5);
        
                    $gateway = \Omnipay\Omnipay::create('Stripe');
                    // $gateway->setApiKey('sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0');
                    // $gateway->setApiKey('sk_test_UE3xmTh2owaSc94Adn91xJOx00ES1c7uqG');
                    // $gateway->setApiKey('sk_live_DOnG2rKpmX3aipEdyCCWuaKC00gjeG2yB9');
                    if(config('app.payment_test')){
                        $gateway->setApiKey(config('app.payment_stripe_test_key'));
                    } else {
                        $gateway->setApiKey(config('app.payment_stripe_key'));
                    }
                    $gateway->setTestMode(true);
                    
                    $token = $gateway->createToken([
                        'card' => [
                            'number' => str_replace('-','',$this->number),
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
                    // dd($customer);

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

                \Log::channel('order')->info('Payment: '.$this->selected_payment);

                $order = $this->createOrder($payment);

                if($this->selected_coupon_price>0){
                    UserCoupon::find($this->selected_coupon)->update([
                        'status' => 'used',
                        'use_count' => 1
                    ]);
                }
                
                if($order->total_amount<=0){
                    $order->payment_status = 'paid';
                    $order->real_amount = 0;
                    $order->payment_method = 'free';
                    $order->paid_at = now();
                    $order->closed = 1;
                    $order->save();
                    auth()->user()->cartItem()->delete();
                    $this->checkingOut = false;
                    session()->flash('message', 'Order successfully created.');
                    // $this->emit('$refresh');
                    return redirect('orders');
                } else {
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
                            // $gateway->setApiKey('sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0');
                            // $gateway->setApiKey('sk_test_UE3xmTh2owaSc94Adn91xJOx00ES1c7uqG');
                            // $gateway->setApiKey('sk_live_DOnG2rKpmX3aipEdyCCWuaKC00gjeG2yB9');
                            if(config('app.payment_test')){
                                $gateway->setApiKey(config('app.payment_stripe_test_key'));
                            } else {
                                $gateway->setApiKey(config('app.payment_stripe_key'));
                            }
                            $gateway->setTestMode(true);
                        
                            $amount = ($this->cartItems->sum('amount') - $this->selected_coupon_price) <=0 ? 0 : $this->cartItems->sum('amount') - $this->selected_coupon_price;
                            $response = $gateway->purchase(array(
                                'amount' => $amount, 'currency' => 'HKD',
                                'customerReference' => $customerReference,
                                'receipt_email' => auth()->user()->email,
                                'description' => 'SCH-DSC-'.$order->no,
                                'metadata' => auth()->user()->cartItem->map(function($product){
                                    return $product->title;
                                })
                            ))->send();
            
                            if ($response->isRedirect()) {
                                // redirect to offsite payment gateway
                                $response->redirect();
                            } elseif ($response->isSuccessful()) {
                                // payment was successful: update database
                                // dd($response);
                                $order->payment_status = 'paid';
                                $order->paid_at = now();
                                $order->closed = 1;
                                $order->save();
                                auth()->user()->cartItem()->delete();
                                $this->checkingOut = false;
                                session()->flash('message', 'Order successfully created.');
                                // $this->emit('$refresh');
                                return redirect('orders');
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
                }

               

            }
        } catch (\Throwable $th) {
            // dd($th);
            // \Log::debug(auth()->user());
            \Log::channel('order')->debug($th->getMessage());
            session()->flash('message', $th->getMessage());
            $this->emit('$refresh');  
        }
        \Log::channel('order')->info('User End of Create Order');
        $this->procced = 'Proceed to checkout';
        // $this->done = true;
    }


    public function genExctrationCode()
    {
        $vertifyCode = mt_rand(100000, 999999);
        return $vertifyCode;
    }

    public function render()
    {
        return view('livewire.checkout-card');
    }
}
