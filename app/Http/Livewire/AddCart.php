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
    public $product, $title, $description, $image, $price;
    public $amount = 0;
    public $menu_product_id;
    public $menu_product_date;
    protected $listeners = ['addToCart' => 'addingProduct'];

    public function mount()
    {
        $this->product = Product::find(1);
    }

    public function addingProduct($id)
    {
        $this->addingToCart = true;
        $this->product = Product::find($id);
        $this->title = $this->product->title;
        $this->description = $this->product->description;
        $this->image = $this->product->image ? $this->product->image : 'https://atlas-content-cdn.pixelsquid.com/assets_v2/140/1406081837838636780/jpeg-600/G03.jpg?modifiedAt=1';
        $this->price = $this->product->price;

        $this->menu_product_id = $this->product->id;
        $this->menu_product_date = date('Y-m-d');
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = User::find(Auth::id());
        $menu_product_id = $this->menu_product_id;
        $menu_product_date = $this->menu_product_date;
        $product_id = $this->product->id;
        $location_id = 2;

        $cart = $user->cartItem()->where([
            'menu_product_id' => $menu_product_id,
            'product_sku_id' => $this->product->skus()->first()->id,
            'store_id' => $location_id,
        ])->first();
        // dd($cart);
        $success = true;

        if (!$cart) {
            $newCart = [
                'store_id' => $location_id,
                'menu_product_id' => $menu_product_id,
                'product_id' => $this->product->id,
                'product_sku_id' => $this->product->skus()->first()->id,
                'quantity' => $this->quantity,
                'price' => $this->price,
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
            ]);
            $message = 'Cart is updated';
            $this->addingToCart = false;
        }
    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
