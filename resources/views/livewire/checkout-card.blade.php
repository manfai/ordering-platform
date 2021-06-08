<div class="flex justify-center w-full my-6 py-12">
  
    <div class="flex flex-col p-8 text-gray-800 bg-base-200 shadow-lg rounded-box w-full pin-r pin-y md:w-4/5 lg:w-4/5">
      <div class="flex-1">
        <table class="w-full text-sm lg:text-base" cellspacing="0">
          <thead>
            <tr class="h-12 uppercase">
              <th class="hidden md:table-cell"></th>
              <th class="text-left">Product</th>
              <th class="lg:text-right text-left pl-5 lg:pl-0">
                <span class="lg:hidden" title="Quantity">Qtd</span>
                <span class="hidden lg:inline">Quantity</span>
              </th>
              <th class="hidden text-right md:table-cell">Price</th>
              <th class="text-right">Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cartItems as $item)
                <tr class="pb-4">
                    <td class="hidden pb-4 md:table-cell">
                        <a href="#">
                        <img src="{{$item->product->image?$item->product->image:'https://atlas-content-cdn.pixelsquid.com/assets_v2/140/1406081837838636780/jpeg-600/G03.jpg?modifiedAt=1'}}" class="w-20 rounded-box" alt="Thumbnail">
                        </a>
                    </td>
                    <td>
                        <a href="#">
                        <p class="mb-2 md:ml-4">{{$item->product->title}}</p>
                            <button wire:click="removeItem({{$item->id}})" type="submit" class="text-gray-700 md:ml-4">
                            <small>(Remove item)</small>
                            </button>
                        </a>
                    </td>
                    <td class="justify-center md:justify-end md:flex mt-6">
                        <div class="w-20 h-10">
                        <div class="relative flex flex-row w-full h-8">
                        <input type="number" disabled value="{{$item->quantity}}" 
                            class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
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
            
          </tbody>
        </table>
        <hr class="pb-6 mt-6">
        <div class="my-4 mt-6 -mx-2 lg:flex text-sm">
          <div class="lg:px-2 lg:w-1/2">
            <div class="p-4 bg-base-300 rounded-lg">
              <h1 class="ml-2 font-bold uppercase">Coupon Code</h1>
            </div>
            <div class="p-4">
              <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
                <div class="grid grid-cols-4 gap-4">
                  @foreach ($coupons as $coupon)
                    <div wire:click="$emit('coupon_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-xl cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                      ${{$coupon->value}}
                    </div>
                  @endforeach
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
                  <div wire:click="$emit('payment_method','{{$payment->code}}')" class="{{ ($selected_payment==$payment->code)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-xl cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                    {{$payment->title}}
                  </div>
                @endforeach
              </div>
            </div>

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
                    ${{ $cartItems->sum('amount') - $selected_coupon_price }}
                    </div>
                  </div>
                <a href="#">
                  <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-lg shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                    <span class="ml-2 mt-5px">Procceed to checkout</span>
                  </button>
                </a>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>