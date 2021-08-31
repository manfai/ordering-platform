
<div class="w-full">
    <!-- Remove py-8 -->
    <div class="">
        
        <div class="grid grid-cols-12">
            <div class="col-span-12 pb-8 px-4 w-full">

            <h3>Menu Date: <code>{{$menu_date}}</code></h3>
            <div class="grid grid-flow-col grid-cols-3 gap-4 py-4">
                <div class="block rounded-lg shadow-lg overflow-hidden bg-white text-center w-full">
                    <div class="text-2xl bg-red-500 text-white py-1">
                        {{date('M',strtotime($menu_date))}}
                    </div>
                    <div class="py-2 border-l border-r">
                        <h2 class="text-3xl font-bold">{{date('d',strtotime($menu_date))}}</h2>
                    </div>
                    <div class="pb-2 px-3 border-l border-r border-b rounded-lg bottom-0 flex justify-between">
                        <h3 class="text-lg font-bold">{{date('D',strtotime($menu_date))}}</h3>
                        <h3 class="text-lg font-bold">{{date('Y',strtotime($menu_date))}}</h3>
                    </div>
                </div>
            </div>
	    </div>
        @auth
        
       

        <div class="hidden col-span-12 pb-8 px-4 w-full">
            @php
            $bentos = auth()->user()->bentos()->where([
                'status' => 'paid',
                'menu_date' => $menu_date
            ])->get();
            @endphp
            <div class="w-full overflow-hidden">
            @if(count($bentos)>0)
            <h3>Ordered:</h3>
            <div class="grid grid-cols-12 gap-4 py-4">
            @foreach ($bentos as $bento)
                <div class="shadow card col-span-4">
                    <div class="card-body p-3">
                    <h5 class="text-md">{{$bento->product->title}}</h5> 
                    <p>Student: {{$bento->remark}}</p>
                    </div>
                </div> 
              
              
               
                {{-- <div class="bg-base-200 shadow-lg mr-3 p-3"> 
                   <p>{{$bento->product->title}}</p>
                    <p>{{$bento->remark}}</p>
                </div> --}}
            @endforeach
            </div>
            @endif
        </div>
        </div>
        @endauth

	    @if(count($products)>0)
            @foreach ($products as $product)
                    <div wire:loading.remove wire:loading.target="changeBrand" class="col-span-6 md:col-span-4 lg:col-span-4 xl:col-span-3 md:flex pb-8 px-4 w-full">
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
