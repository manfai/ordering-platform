
<div class="w-full">
    <!-- Remove py-8 -->
    <div class="">
        
        <div class="grid grid-cols-12">
            <div class="col-span-12 pb-8 px-4 w-full">
                <img src="https://via.placeholder.com/1920x500" class="rounded-box shadow-lg w-full h-84 object-cover object-center">
            </div>

          
            @if(count($products)>0)
            @foreach ($products as $product)
                    <div wire:loading.remove wire:loading.target="changeBrand" class="col-span-6 md:col-span-4 lg:col-span-3 xl:col-span-3 md:flex pb-8 px-4 w-full">
                        <div class="card bordered shadow-lg w-full rounded-box bg-base-200">
                            <figure class="px-4 pt-4">
                                <img src="{{$product->image_file? $product->image_file : 'https://image.freepik.com/free-psd/delivery-food-brown-box-mockup_181945-514.jpg'}}" class="h-40 object-cover object-center rounded-box bg-default-parttern bg-cover bg-center">
                            </figure> 
                            <div class="card-body h-30 px-5 pt-4 pb-0">
                            <span class="menu-title text-opacity-50 text-xs text-gray-800">{{$product->brand->name}}</span>
                            <h4 class="font-bold text-xs lg:text-md">
                                {{$product->title}}
                            </h4> 
                            <p class="hidden lg:block text-xs mt-2">{{ mb_strimwidth($product->description, 0, 50, "...") }}</p> 
                            </div>
                            <div class="pb-4 px-5 w-full flex justify-between card-actions">
                                <h3 class="text-md font-bold">
                                    ${{$product->price}}
                                </h3>
                                <button wire:click="addToCart({{$product->id}})" class="btn btn-primary btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</button>
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
