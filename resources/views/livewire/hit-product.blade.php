<div>
    <!-- Remove py-8 -->
    <div class="mx-auto container">

    <h3 class="mb-5 px-4 text-xl font-bold text-gray-400">
                        Hit Product
                    </h3>
        <div class="grid auto-cols-max grid-cols-12">

            @foreach ($products as $product)
            <div wire:loading.remove wire:loading.target="changeBrand" class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-4 md:flex pb-8 px-4 w-full ">
                <div class="card bordered shadow-lg w-full rounded-box bg-base-200">
                    <figure class="px-4 pt-4">
                        <img src="{{$product->image_file? $product->image_file : 'https://image.freepik.com/free-psd/delivery-food-brown-box-mockup_181945-514.jpg'}}" class="h-40 object-cover object-center rounded-box bg-default-parttern bg-cover bg-center">
                    </figure>
                    <div class="card-body h-30 px-5 pt-4 pb-0">
                        <span class="menu-title text-opacity-50 text-sm text-gray-800">{{$product->brand->name}}</span>
                        <h4 class="font-bold text-md">
                            {{$product->title}}
                        </h4>
                        <p class="text-sm mt-2">{{$product->description}}</p>
                    </div>
                    <div class="pb-4 px-5 w-full flex justify-between card-actions">
                        <h3 class="text-lg font-bold">
                            ${{$product->price}}
                        </h3>
                        <button wire:click="addToCart({{$product->id}})" class="btn btn-primary btn-sm m-0 rounded-lg">{{__('Add To Cart')}}</button>
                    </div>
                </div>
            </div>
            @endforeach


        </div>

    </div>
</div>