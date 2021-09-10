<div class="w-full">
    <!-- Remove py-8 -->
    <div class="">

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 pb-1 w-full">

                <!-- <h3 class="mb-6">Menu Date: <code>{{$menu_date}}</code></h3> -->
                <div id="menu-date" class="w-full flex overflow-x-scroll pb-8 pl-2 -ml-2 lg:pl-0 lg:-ml-0 lg:pb-0 lg:overflow-x-visible">
                    <!-- <div class="grid grid-flow-col grid-cols-12 gap-4 py-4"> -->

                    @foreach($period as $date)
                    <div id="{{$date}}" class="{{$date==$menu_date?'flex':'lg:hidden flex'}} mr-4">
                        <a @if($date!==$menu_date) href="{{route('welcome')}}?menu={{base64_encode( serialize(['menu_date'=>$date]) )}}" @endif>
                            <div class="bg-base-200 shadow-lg w-32 block rounded-lg col-span-2 overflow-hidden text-center">
                                <div class="py-3 {{$menu_date===$date?'bg-primary':' bg-primary-focus cursor-pointer hover:shadow-lg'}}">
                                    <h3 class="text-white text-md">{{date('M',strtotime($date))}}</h3>
                                </div>
                                <div class="py-3">
                                    <h2 class="text-2xl text-base-content font-bold">{{date('d',strtotime($date))}}</h2>
                                </div>
                                <div class="text-base-content pb-3 rounded-b-lg px-3 bottom-0 flex justify-between">
                                    <h3 class="text-md font-bold">{{date('D',strtotime($date))}}</h3>
                                    <h3 class="text-md font-bold">{{date('Y',strtotime($date))}}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @push('scripts')
                    <script>
                        $('#menu-date').scrollTo('#{{$menu_date}}')
                    </script>
                    @endpush
                </div>

            </div>

            @auth

            <div class="col-span-12 pt-8 w-full">
                @php
                $bentos = auth()->user()->bentos()->where([
                'status' => 'paid',
                'menu_date' => $menu_date
                ])->get();
                @endphp
                <div class="w-full overflow-hidden">
                    @if(count($bentos)>0)
                    <div class="grid grid-cols-12 gap-4 py-4">
                        <h3 class="col-span-12 font-semibold">Ordered:</h3>
                        @foreach ($bentos as $k => $bento)
                        <div class="stat shadow rounded-box bg-base-200 col-span-4">
                            <div class="stat-figure text-info">
                              <div class="avatar">
                                <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                                  <img class="mask mask-squircle" src="{{$bento->product->image_file? $bento->product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}">
                                </div>
                              </div>
                            </div> 
                            {{-- <div class="stat-value">{{$k}}</div>  --}}
                            <div class="text-md">{{$bento->product->title}}</div> 
                            <div class="stat-desc font-bold text-info">Student: {{$bento->remark}}</div>
                          </div>

                        {{-- <div class="card lg:card-side bordered col-span-4">
                            <figure>
                              <img class="h-20" src="{{$bento->product->image_file? $bento->product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}">
                            </figure> 
                            <div class="card-body">
                              <h2 class="card-title">{{$bento->product->title}}</h2> 
                              <p></p>
                              <div class="card-actions hidden">
                                <button class="btn btn-primary">Get Started</button> 
                                <button class="btn btn-ghost">More info</button>
                              </div>
                            </div>
                          </div>  --}}
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endauth

        @if(count($products)>0)
        @if(count($bentos)>0)
        <h3 class="col-span-12 font-semibold">Menu:</h3>
        @endif
        @foreach ($products as $product)
        <div wire:loading.remove wire:loading.target="changeBrand" class="col-span-6 md:col-span-4 lg:col-span-4 xl:col-span-3 md:flex pb-8 w-full indicator">
            <div class="card bordered shadow-lg w-full rounded-box bg-base-200">
                <figure class="px-4 pt-4">
                    <img src="{{$product->image_file? $product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}" class="h-40 object-cover object-center rounded-box bg-cover bg-center">
                </figure>
                <div class="card-body h-30 px-5 pt-4 pb-0">
                    <span class="menu-title text-opacity-50 text-xs text-gray-800">
                        @php
                        try {
                        $product->brand->name;
                        } catch (\Throwable $th) {
                        $product->id;
                        }
                        @endphp
                    </span>
                    <h4 class="font-bold text-xs lg:text-md">
                        {{$product->title}}
                    </h4>
                    <p class="hidden lg:block text-xs mt-2">{{ mb_strimwidth($product->description, 0, 50, "...") }}</p>
                </div>
                <div class="pb-4 px-5 w-full mt-3 justify-between">
                    <h3 class="text-md font-bold mb-3">
                        ${{$product->price}}
                    </h3>
                    @auth
                    <button wire:click="addToCart({{$product->id}},'{{$menu_date}}')" class="btn btn-primary btn-block w-full btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</button>
                    @else
                    <a href="{{route('login')}}" class="btn btn-primary btn-block btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</a>
                    @endauth
                </div>
            </div>
            <!-- ordered -->
            @auth
                @php
                $ordered = \App\Models\Order\OrderItem::where([
                        'user_id'=>auth()->user()->id,
                        'product_id'=>$product->id,
                        'status'=>'paid',
                        'menu_date'=>$menu_date,
                    ])->exists();
                @endphp
                @if($ordered)
                <div class="indicator-item badge badge-info uppercase text-xs py-4" style="right:20px!important">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                @endif
            @endauth
        </div>
        @endforeach
        @endif
        @livewire('add-cart')
        @if ($products)
        <div class="col-span-12 px-4 py-8">
            {{ $products->links() }}
        </div>
        @endif
    </div>

</div>
</div>