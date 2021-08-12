<div>
    <!-- Remove py-8 -->
    <div class="mx-auto container">
        <div class="grid auto-cols-max grid-cols-12">

            <div class="col-span-12 pb-8 px-4 w-full">

                <div class="overflow-x-auto">

                    <h3 class="mb-5 text-xl font-bold text-gray-400">
                        Order List
                    </h3>

                    <table class="table w-full">
                        <thead>
                            <tr>
                                <!-- <th>
                                    <label>
                                        <input type="checkbox" class="checkbox">
                                        <span class="checkbox-mark"></span>
                                    </label>
                                </th> -->
                                <th>Order</th>
                                <th>Payment</th>
                                <th>Bento / Product</th>
                                <th>Code</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <!-- <th>
                                    <label>
                                        <input type="checkbox" class="checkbox">
                                        <span class="checkbox-mark"></span>
                                    </label>
                                </th> -->
                                <td>
                                    <span class="text-sm">{{$order->no}}</span><br>
                                    <span class="badge badge-outline badge-sm uppercase">{{$order->payment_status}}</span>
                                </td>
                                <td class="text-gray-500">
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
                                <!-- <i class="fas fa-mobile-alt fa-lg"></i> --><i class="fas fa-wallet fa-lg"></i>
                                @break
                                
                                @endswitch
                                </td>
                                <td>
                                <div class="avatar-group -space-x-6">
                                    @foreach($order->items as $key => $item)
                                        @if($key<=3)
                                        <div class="avatar">
                                        <div class="w-10 h-10">
                                            <img src="{{$item->product->image_file}}">
                                        </div>
                                        </div> 
                                        @else
                                        <div class="avatar placeholder">
                                            <div class="bg-neutral-focus text-neutral-content rounded-full w-10 h-10">
                                            <span>+{{count($order->items) - 4}}</span>
                                            </div>
                                        </div>
                                        @endif
                                        
                                    @endforeach
                                    </div> 
                                    
                                </td>
                                <td><code class="text-sm text-red-600">{{$order->extraction_code}}</code></td>
                                <td>${{$order->real_amount}}
                                <td>{{
                                    $order->charges()->where('value','<=',0)->get()->sum('value')
                                }}</td>
                                <th>
                                    <button wire:click="viewDetail({{$order->id}})" class="btn btn-primary btn-xs">details</button>
                                    <!-- <button wire:click="viewDetail({{$order->id}})" class="btn btn-primary btn-xs">receipt</button> -->
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- <th></th> -->
                                <th>Order</th>
                                <th>Payment</th>
                                <th>Bento / Product</th>
                                <th>Code</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                    @if ($orders)
                    <div class="col-span-12 px-4 py-8">
                        {{ $orders->links() }}
                    </div>
                    @endif
                    
                </div>

            </div>

        </div>

    </div>
</div>