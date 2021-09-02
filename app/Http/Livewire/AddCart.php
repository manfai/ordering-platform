<?php

namespace App\Http\Livewire;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddCart extends Component
{
    public $addingToCart = false;
    public $quantity = 1;
    public $remark;
    public $product, $title, $description, $image, $price;
    public $amount = 0;
    public $menu_product_id;
    public $menu_product_date;
    public $students = [];
    public $student = [
        'class'=>'',
        'name' =>''
    ];
    public $new_student = '';
    public $disabledButton = true;
    public $disabledRemark = true;
    protected $listeners = ['addToCart' => 'addingProduct'];

    protected $rules = [
        'remark'        => 'required',
        'student.class' => 'required_if:remark,"New Student"|string',
        'student.name'  => 'required_if:remark,"New Student"|string',
    ];

 

    public function mount()
    {
        $this->product = Product::find(1);
	if(Auth::user()){
		$this->students = Auth::user()->merchant->students;
	} else {
		$this->students = [];
	}
        // dd($this->students);
    }

    public function addingProduct($productId,$menuDate = null)
    {
        // dd($menuDate);
        $this->addingToCart = true;
        $this->product = Product::find($productId);
        $this->title = $this->product->title;
        $this->description = $this->product->description;
        $this->image = $this->product->image_file ? $this->product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg';
        $this->price = $this->product->price;

        $this->menu_product_id = $this->product->id;
        if($menuDate){
            $this->menu_product_date = $menuDate;
        } else {
            $this->menu_product_date = date('Y-m-d');
        }
    }
    
    public function updatedRemark($value)
    {
        if(!in_array($value,$this->students)){
            
            $this->disabledRemark = true;
            $this->disabledButton = true;

        } else {
            
        
            if($value == "New Student"){
                // dd($value);
                $this->disabledRemark = false;
                $this->disabledButton = false;
            } else if($value!=='---'&&$value!==null){
                $this->disabledButton = false;
                $this->disabledRemark = true;
            } else  {
                $this->disabledRemark = true;
                $this->disabledButton = true;
            }

        }
    }

    public function addToCart()
    {
        // dd($this->remark);
        // dd(empty($this->student));
        try {
            
        $this->validate();
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        $user = User::find(Auth::id());
        $menu_product_id = $this->menu_product_id;
        $menu_product_date = $this->menu_product_date;
        $product_id = $this->product->id;
        $location_id = 57;

        $cart = $user->cartItem()->where([
            'menu_product_id' => $menu_product_id,
            'product_sku_id' => $this->product->skus()->first()->id,
            'store_id' => $location_id,
        ])->first();
        $success = true;

        $this->emit('$refresh');
        if($this->remark=='New Student'){
            $student = $this->student;
            $class = $student['class'];
            $name  = $student['name'];
            if($class && $name){
                $this->new_student = $class.'--'.$name;
                $this->remark = str_replace('_','',$this->new_student);
                $newRemark = $user->merchant->remark;
                $newRemark[] = $this->remark;
                $user->merchant->remark = $newRemark;
                $user->merchant->save();
            }
        }
       
        if (!$cart) {
            $newCart = [
                'store_id' => $location_id,
                'menu_product_id' => $menu_product_id,
                'product_id' => $this->product->id,
                'product_sku_id' => $this->product->skus()->first()->id,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'remark' => $this->remark,
                'amount' => $this->quantity * $this->price,
                'menu_date' => $menu_product_date,
                'period_id' => 2
            ];
            $user->cartItem()->create($newCart);
            $message = 'Added to cart';
            $this->addingToCart = false;
        } else {
            $cart->update([
                'quantity' => ($cart->quantity + $this->quantity),
                'amount' => ($cart->quantity + $this->quantity) * $this->price,
                'remark' => ($cart->remark . ', ' . $this->remark),
            ]);
            $message = 'Cart is updated';
            $this->addingToCart = false;
        }
        
        $this->reset(['quantity','remark','student']);
        $this->disabledButton = true;
        $this->disabledRemark = true; 
        
        $this->emitTo('cart-count', 'refreshCart');
        $this->emitTo('sub-menu', 'refreshCart');
        $this->emit('$refresh');

        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('message', $th->getMessage());
            $this->emit('$refresh');  
        }
        // return redirect('?menu='.request('menu') );
        // return redirect()->back();
    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
