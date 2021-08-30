{{-- <x-jet-dialog-modal wire:model="checkingOut" maxWidth="5xl">

  <x-slot name="title">
  </x-slot>

  <x-slot name="content">
      <h3 class="text-2xl">你的購物車</h3>
      <hr class="pb-6 mt-6">
      <table class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
          <tr class="h-12 uppercase">
            <th class="hidden md:table-cell">圖片</th>
            <th class="text-left">商品名稱</th>
            <th class="lg:text-right text-left pl-5 lg:pl-0">
              <span class="lg:hidden" title="Quantity">數量</span>
              <span class="hidden lg:inline">數量</span>
            </th>
            <th class="hidden text-right md:table-cell">價錢</th>
            <th class="text-right">總額</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cartItems as $item)
          <tr>
            <td class="hidden pb-4 md:table-cell text-center">
              <a href="#">
                <img src="{{$item->product->image_file?$item->product->image_file:'https://image.freepik.com/free-psd/delivery-food-brown-box-mockup_181945-514.jpg'}}" class="w-20 h-14 object-cover rounded-box" alt="Thumbnail">
</a>
</td>
<td>
  <a href="#">
    <p class="mb-2 md:ml-4">{{$item->product->title}}</p>
    <button wire:click="removeItem({{$item->id}})" type="submit" class="text-gray-700 md:ml-4">
      <small class="text-red-500"><u>{{__('Remove item')}}</u></small>
    </button>
  </a>
</td>
<td class="justify-center md:justify-end md:flex mt-6">
  <div class="w-20 h-10">
    <div class="relative flex flex-row w-full h-5 text-center">
      <input type="number" disabled value="{{$item->quantity}}" class="text-sm text-center w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
    </div>
  </div>
</td>
<td class="hidden text-right md:table-cell">
  <span class="text-sm lg:text-base font-medium">
    ${{$item->price}}
  </span>
</td>
<td class="text-right">
  <span class="text-sm lg:text-base font-medium">
    ${{$item->amount}}
  </span>
</td>
</tr>
@endforeach
@if(count($cartItems)<=0) <tr>
  <td colspan="5" class="text-center p-6">
    <h3>No Data.</h3>
    <button class="mt-3 btn btn-primary rounded-lg">
      Shopping Now
    </button>
  </td>
  </tr>
  @endif
  </tbody>
  </table>
  @if(count($cartItems)>0)
  <hr class="pb-6 mt-6">
  <form wire:submit.prevent="submit">
    <div class="my-4 mt-6 -mx-2 lg:flex text-sm">
      <div class="lg:px-2 lg:w-1/2">
        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Coupon Code</h1>
        </div>
        <div class="p-4">
          <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
          <div class="grid grid-cols-4 gap-4">
            @foreach ($coupons as $coupon)
            <div wire:click="$emit('coupon_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              ${{$coupon->value}}
            </div>
            @endforeach
          </div>
        </div>

        <div class="p-4 mt-6 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Shipping Option</h1>
        </div>
        <div class="p-4">
          <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
          <div class="grid grid-cols-2 gap-4">
            <div wire:click="$emit('shipping_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              Self Pick-Up
            </div>
            <div wire:click="$emit('shipping_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              Delivery
            </div>
          </div>
        </div>

        <div class="p-4 mt-6 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Instruction for seller</h1>
        </div>

        <div class="p-4">
          <p class="mb-4 italic">If you have some information for the seller you can leave them in the box below</p>
          <textarea class="w-full h-24 p-2 bg-base-100 rounded"></textarea>
        </div>
      </div>

      <div class="lg:px-2 lg:w-1/2">
        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Payment Method</h1>
        </div>
        <div class="p-4">
          <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
          <div class="grid grid-cols-3 grid-rows-3 gap-4">
            @foreach ($payments as $payment)
            <div wire:click="$emit('payment_method','{{$payment->code}}')" class="{{ ($selected_payment==$payment->code)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              {{$payment->title}}
            </div>
            @endforeach

            <div wire:click="$emit('payment_method','new')" class="{{ ($selected_payment=='new')?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              New
            </div>

          </div>
          @if($selected_payment == 'new')
          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">New Credit Card</h1>
          </div>
          <div class="p-4 grid grid-cols-3 gap-4">
            <input type="text" class="col-span-3" wire:model.defer="number">
            <input type="text" wire:model.defer="exp_month">
            <input type="text" wire:model.defer="exp_year">
            <input type="text" wire:model.defer="cvc">
          </div>
          @endif

          @if($selected_payment == 'stripe')
          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">Choose Your Card</h1>
          </div>
          <div class="p-4 grid grid-cols-2 gap-4">
            @foreach(auth()->user()->payments()->where(['brand'=>'STRIPE'])->get() as $card)
            <div wire:click="updateCardPayment('{{$card->id}}')" class="{{ ($selected_card==$card->id) ? 'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              {{$card->name}}
            </div>
            @endforeach
          </div>
          @endif


          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">Order Details</h1>
          </div>
          <div class="p-4">
            <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                Subtotal
              </div>
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                ${{$cartItems->sum('amount')}}
              </div>
            </div>
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                Discount
              </div>
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                ${{0}}
              </div>
            </div>
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                Coupon
              </div>
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                ${{$selected_coupon_price}}
              </div>
            </div>
            <div class="flex justify-between border-b">
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                Shipping
              </div>
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                ${{0}}
              </div>
            </div>


            <div class="flex justify-between pt-4 border-b">
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                Total
              </div>
              <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                ${{ ($cartItems->sum('amount') - $selected_coupon_price) <=0 ? 0 : $cartItems->sum('amount') - $selected_coupon_price }}
              </div>
            </div>


            @if(session()->has('message'))
            <span class="mt-6 text-red-500"><code>*** </code>{{ session('message') }}</span>
            @endif
            <button type="submit" class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-lg shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
              <span class="ml-2 mt-5px text-xl">Procceed to checkout</span>
            </button>

          </div>
        </div>
      </div>
  </form>
  @endif
  </x-slot>

  <x-slot name="footer">

  </x-slot>
  </x-jet-dialog-modal> --}}
  <div>

    <h3 class="text-2xl">Your Cart</h3>
    <hr class="pb-6 mt-6">
    <table class="w-full text-sm lg:text-base" cellspacing="0">
      <thead>
        <tr class="h-12 uppercase">
          <th class="hidden md:table-cell text-left">Picture</th>
          <th class="text-left">Product</th>
          <th class="lg:text-right text-left pl-5 lg:pl-0">
            <span class="lg:hidden" title="Quantity">QTY</span>
            <span class="hidden lg:inline">QTY</span>
          </th>
          <th class="hidden text-right md:table-cell">Price</th>
          <th class="text-right">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cartItems->sortBy('menu_date') as $item)
        <tr>
          <td class="hidden pb-4 md:table-cell text-center">
            <a href="#">
              <img src="{{$item->product->image_file?$item->product->image_file:'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}" class="w-20 h-14 object-cover rounded-box" alt="Thumbnail">
            </a>
          </td>
          <td>
            <a href="#">
              <p class="mb-2">{{$item->product->title}}</p>
              <p class="mb-2">Menu Date: <code>{{date('Y-m-d',strtotime($item->menu_date))}}</code></p>
              <p class="mb-2">Remark: {{$item->remark}}</p>
              <button wire:click="removeItem({{$item->id}})" type="submit" class="text-gray-700 mb-5">
                <small class="text-red-500 text-xs"><u>{{__('Remove item')}}</u></small>
              </button>
            </a>
          </td>
          <td class="justify-center md:justify-end md:flex mt-6">
            <div class="w-20 h-10">
              <div class="relative flex flex-row w-full h-5 text-center">
                <input type="number" disabled value="{{$item->quantity}}" class="text-sm text-center w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
              </div>
            </div>
          </td>
          <td class="hidden text-right md:table-cell">
            <span class="text-sm lg:text-base font-medium">
              ${{$item->price}}
            </span>
          </td>
          <td class="text-right">
            <span class="text-sm lg:text-base font-medium">
              ${{$item->amount}}
            </span>
          </td>
        </tr>
        @endforeach
        @if(count($cartItems)<=0) <tr>
          <td colspan="5" class="text-center p-6">
            <h3>No Data.</h3>
            <button class="mt-3 btn btn-primary rounded-lg">
              Shopping Now
            </button>
          </td>
          </tr>
          @endif
      </tbody>
    </table>
    @if(count($cartItems)>0)

    <hr class="pb-6 mt-6">
    <h3 class="text-2xl">Checkout Now</h3>
    <form wire:submit.prevent="submit">
      <div class="my-4 mt-6 -mx-2 lg:flex text-sm">
        <div class="hidden lg:px-2 lg:w-1/2">
          <div class="p-4 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">Coupon Code</h1>
          </div>
          <div class="p-4">
            <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
            <div class="grid grid-cols-4 gap-4">
              @foreach ($coupons as $coupon)
              <div wire:click="$emit('coupon_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                ${{$coupon->value}}
              </div>
              @endforeach
            </div>
          </div>

          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">Shipping Option</h1>
          </div>
          <div class="p-4">
            <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
            <div class="grid grid-cols-2 gap-4">
              <div wire:click="$emit('shipping_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                Self Pick-Up
              </div>
              <div wire:click="$emit('shipping_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                Delivery
              </div>
            </div>
          </div>

          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">Instruction for seller</h1>
          </div>

          <div class="p-4">
            <p class="mb-4 italic">If you have some information for the seller you can leave them in the box below</p>
            <textarea class="w-full h-24 p-2 bg-base-100 rounded"></textarea>
          </div>
        </div>
        <div class="lg:px-2 lg:w-1/2">
          <div class="p-4 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">Payment Method</h1>
          </div>
          <div class="p-4">
            <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
            @php
            $userCards = auth()->user()->payments()->where(['brand'=>'STRIPE'])->get();
            @endphp
            <div class="grid grid-cols-3 grid-rows-3 gap-4">
              @if(count($userCards)>0)
                @foreach ($payments as $payment)
                  <div wire:click="$emit('payment_method','{{$payment->code}}')" class="{{ ($selected_payment==$payment->code)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                    {{$payment->title}}
                  </div>
                @endforeach
              @endif

              <div wire:click="$emit('payment_method','new')" class="{{ ($selected_payment=='new')?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                New Credit Cards
              </div>

            </div>
            @if($selected_payment == 'new')
            <div class="p-4 mt-6 bg-base-300 rounded-lg">
              <h1 class="ml-2 font-bold uppercase">New Credit Card</h1>
            </div>
            <div class="p-4 grid grid-cols-3 gap-4">
              <input type="text" class="col-span-3" wire:model.defer="number" placeholder="number">
              <input type="text" wire:model.defer="exp_month" placeholder="exp_month">
              <input type="text" wire:model.defer="exp_year" placeholder="exp_year">
              <input type="text" wire:model.defer="cvc" placeholder="cvc">
            </div>
            @endif

            @if($selected_payment == 'stripe')
            <div class="p-4 mt-6 bg-base-300 rounded-lg">
              <h1 class="ml-2 font-bold uppercase">Choose Your Card</h1>
            </div>
            <div class="p-4 grid grid-cols-2 gap-4">
              @foreach($userCards as $card)
              <div wire:click="updateCardPayment('{{$card->id}}')" class="{{ ($selected_card==$card->id) ? 'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                {{$card->name}}
              </div>
              @endforeach
            </div>
            @endif

          </div>
        </div>

          <div class="lg:px-2 lg:w-1/2">


            <div class="p-4 bg-base-300 rounded-lg">
              <h1 class="ml-2 font-bold uppercase">Order Details</h1>
            </div>
            <div class="p-4">
              <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
              <div class="flex justify-between border-b">
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                  Subtotal
                </div>
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                  ${{$cartItems->sum('amount')}}
                </div>
              </div>
              <div class="flex justify-between border-b">
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                  Discount
                </div>
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                  ${{0}}
                </div>
              </div>
              <div class="flex justify-between border-b">
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                  Coupon
                </div>
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                  ${{$selected_coupon_price}}
                </div>
              </div>
              <div class="flex justify-between border-b">
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                  Shipping
                </div>
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                  ${{0}}
                </div>
              </div>


              <div class="flex justify-between pt-4 border-b">
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
                  Total
                </div>
                <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
                  ${{ ($cartItems->sum('amount') - $selected_coupon_price) <=0 ? 0 : $cartItems->sum('amount') - $selected_coupon_price }}
                </div>
              </div>


              @if(session()->has('message'))
              <span class="mt-6 text-red-500"><code>*** </code>{{ session('message') }}</span>
              @endif
              <button  {{
                $done==true ?'type="submit"':'disabled'
              }} class="flex justify-center w-full px-10 py-3 mt-6 font-medium uppercase btn btn-primary rounded-lg shadow item-center focus:shadow-outline focus:outline-none">
                <span class="ml-2 mt-5px text-xl">Procceed to checkout</span>
              </button>

            </div>
          </div>

        </div>
    </form>
    @endif
  </div>