<x-jet-dialog-modal wire:model="viewingDetail" maxWidth="5xl">

  <x-slot name="title">
  </x-slot>

  <x-slot name="content">

      <div class="w-40 h-50 bg-primary p-6 rounded-lg mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-24" viewBox="0 0 807.14 466.85"><defs><style>.cls-1{fill:#fff;}</style></defs><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M.13,206.76V5.4H135.5v41H47.05V84.47h83.62v39H47.05v41.81h93.57v41.52Z"></path><path class="cls-1" d="M317,203.21q-19.62,9-45.22,9a117.89,117.89,0,0,1-43.08-7.68,99.46,99.46,0,0,1-57-55.46q-8.25-19.62-8.25-43.23,0-24.17,8.39-43.8a97.45,97.45,0,0,1,23.18-33.42A102.78,102.78,0,0,1,229.64,7.4a124.32,124.32,0,0,1,84.9.14q20.61,7.53,33.41,22l-33,33a40.87,40.87,0,0,0-17.91-13.94,59.57,59.57,0,0,0-22.76-4.55,57.59,57.59,0,0,0-23.46,4.7,54.93,54.93,0,0,0-18.35,12.94A59,59,0,0,0,220.54,81.2a68.85,68.85,0,0,0-4.27,24.6,70.85,70.85,0,0,0,4.27,25,58.28,58.28,0,0,0,11.8,19.48A53.17,53.17,0,0,0,250.4,163a57.46,57.46,0,0,0,23,4.55q14.51,0,25.31-5.69A49,49,0,0,0,316.1,147l33.84,31.85A95.71,95.71,0,0,1,317,203.21Z"></path><path class="cls-1" d="M182.59,466.85l1.14-142.49h-.86L130.54,466.85H96.41L45.51,324.36h-.86l1.14,142.49H0V265.49H69.2L115,394.61h1.14L160,265.49h70.34V466.85Z"></path><path class="cls-1" d="M408.12,466.85l-15.64-39.53H314.55l-14.79,39.53h-52.9l84.47-201.36h47.21l83.62,201.36Zm-54-147.61-25.59,69.11h50.62Z"></path><path class="cls-1" d="M586.73,466.85,543,386.93H526.43v79.92H478.94V265.49h76.79a133.29,133.29,0,0,1,28.29,3,73.76,73.76,0,0,1,24.75,10.1,52.91,52.91,0,0,1,17.49,18.77q6.54,11.67,6.54,29,0,20.47-11.09,34.41T591,380.67l52.62,86.18Zm-2-139.65q0-7.09-3-11.51a20.52,20.52,0,0,0-7.71-6.83,33.76,33.76,0,0,0-10.58-3.27,78.23,78.23,0,0,0-11.29-.85h-26v46.92H549.3a79.06,79.06,0,0,0,12.29-1A39.09,39.09,0,0,0,573,347.11a21.74,21.74,0,0,0,8.43-7.39Q584.73,334.89,584.74,327.2Z"></path><path class="cls-1" d="M750.26,307V466.85H701.63V307H644.75V265.49H807.14V307Z"></path></g></svg>
      </div>
      
      @if($order)


      <div>
      
            <div class="card bg-base-100">
                
                <div class="invoice p-5 grid grid-cols-3">
                   
                    <div class="col-span-3">
                      <div class="px-4 mt-6">
                      <h5>Your order Confirmed!</h5> 
                      <span class="font-weight-bold mt-4 mb-8">Hello, Chris</span> <span>You order has been confirmed and will be shipped in next two days!</span>
                      </div>
                      <div class="payment border-top mt-3 mb-3 border-bottom table-responsive ">
                          <table class="table table-borderless w-full">
                              <tbody>
                                  <tr>
                                      <td>
                                          <div class="py-2"> <span class="d-block text-muted">Order Date</span> 
                                          <br><span>{{$order->created_at}}</span> </div>
                                      </td>
                                      <td>
                                          <div class="py-2"> <span class="d-block text-muted">Order No</span> 
                                          <br><span>{{$order->no}}</span> </div>
                                      </td>
                                      <td>
                                          <div class="py-2"> 
                                          <span class="d-block text-muted">Payment</span> 
                                          <br><span>
                                          @switch($order->payment_method)
                                          @case('stripe')
                                          <i class="fab fa-cc-stripe fa-lg"></i>
                                          @break
                                          @case('master')
                                          @case('mastercard')
                                          <i class="fab fa-cc-mastercard fa-lg"></i>
                                          @break
                                          @case('visa')
                                          <i class="fab fa-cc-visa fa-lg"></i>
                                          @break
                                          @case('applepay')
                                          <i class="fab fa-cc-apple-pay fa-lg"></i>
                                          @break
                                          @case('asiapay')
                                          <i class="fab fa-alipay fa-lg"></i>
                                          @break
                                          @case('POS')
                                          <i class="fas fa-wallet fa-lg"></i>
                                          @break
                                          
                                          @endswitch
                                          </span> 
                                          </div>
                                      </td>
                                      <td>
                                          <div class="py-2"> <span class="d-block text-muted">Shiping Address</span> 
                                          <br><span>{{$order->ship_status}}</span> </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="col-span-3 product mb-6 w-full">
                        <table class="w-full table table-borderless">
                            <tbody>
                              @foreach($order->items as $item)
                                <tr>
                                    <td width="10%"> <img class="mask mask-squircle" src="{{$item->product->image_file}}" width="100%"> </td>
                                    <td width="70%"> <span class="font-weight-bold">{{$item->product->title}}</span>
                                        <div class="product-qty"> <span class="d-block">Quantity:{{$item->quantity}}</span></div>
                                    </td>
                                    <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold">$67.50</span> </div>
                                    </td>
                                </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="summary mb-6 bg-red-500 col-span-1 md:col-end-4 col-end-3">
                      <table class="table table-borderless w-full">
                                <tbody class="totals">
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>${{$order->charges()->where('remark','like','Product%')->get()->sum('value')}}</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>${{$order->charges()->where('remark','like','Shipping%')->get()->sum('value')}}</span> </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="text-success">${{$order->charges()->where('value','<=','0')->get()->sum('value')}}</span> </div>
                                        </td>
                                    </tr>
                                    <tr class="border-top border-bottom">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                                        </td>
                                        <td>
                                            <!-- <div class="text-right"> <span class="font-weight-bold">${{$order->charges()->get()->sum('value')}}</span> </div> -->
                                            <div class="text-right"> <span class="font-weight-bold">${{$order->real_amount}}</span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="col-span-3 mt-6">
                      <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                      <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>Nike Team</span>
                      <div class=" justify-content-between footer"> <span>Need Help? visit our <a href="#"> help center</a></span> <span>{{$order->created_at}}</span> </div>
                    </div>
                </div>
            </div>
        </div>
      @endif
  </x-slot>

  <x-slot name="footer">

  </x-slot>
</x-jet-dialog-modal>