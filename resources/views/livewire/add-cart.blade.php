{{-- <x-jet-dialog-modal wire:model="addingToCart" maxWidth="7xl">

  <x-slot name="title">
      {{__('Product Detail')}}
  </x-slot>

  <x-slot name="content">
     
      <div class="flex h-56">
          <div class="w-1/3 bg-cover bg-center" style="background-image: url('{{$image}}')">
          </div> 
          <div class="w-2/3 p-4 pt-0">
            <h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2>
            <h1 class="text-gray-900 font-bold text-2xl">{{$title}}</h1>
            <p class="mt-2 text-gray-600 text-sm">{{$description}}</p>
            <p class="mt-2 text-gray-600 text-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            <p><x-input.quantity wire:model="quantity" /></p>    
            <div class="relative">
                <select wire:model="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10 w-40 mt-4">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                </select>
                
              </div>        
          </div>
      </div>
  </x-slot>

  <x-slot name="footer">
      <div class="flex item-center justify-between">
          <h1 class="text-gray-700 font-bold text-3xl pt-2">${{$price}}</h1>
          <button wire:click="addToCart()" class="px-3 py-2 btn btn-primary font-bold uppercase rounded">{{__('Add to Cart')}}</button>
        </div>

  </x-slot>
  
</x-jet-dialog-modal> --}}
<x-jet-dialog-modal wire:model="addingToCart" maxWidth="5xl">
    <x-slot name="title">
    </x-slot>
    <x-slot name="content">
        @if($product)
        <section class="text-gray-600 body-font overflow-hidden">
          <div class="container mx-auto">
            <div class="lg:w-5/5 mx-auto flex flex-wrap">
              <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{$image}}">
              <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$product->brand->name}}</h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$title}}</h1>
                <div class="flex mb-4">
                  <span class="flex items-center">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-yellow-500" viewBox="0 0 24 24">
                      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <span class="text-gray-600 ml-3">4 Reviews</span>
                  </span>
                
                </div>
                <p class="leading-relaxed">{{$description}}</p>
                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                  <div class="flex items-center">
                    <span class="mr-3">{{__('Quantity')}}</span>
                    <x-input.quantity wire:model="quantity" />
                  </div>
                </div>
                <div class="flex">
                  <span class="title-font font-medium text-2xl py-2 pr-6 text-gray-900">${{$price}}</span>
                  <button wire:click="addToCart()" class="flex ml-auto text-white btn-primary btn border-0 py-2 px-6 focus:outline-none">{{__('Add to Cart')}}</button>  
                </div>
              </div>
            </div>
          </div>
        </section>
        @endif
    </x-slot>
    <x-slot name="footer">
      {{-- <div class="w-full flex item-center justify-between">
          <h1 class="text-gray-700 font-bold text-3xl pt-2">${{$price}}</h1>
          <button wire:click="addToCart()" class="px-3 py-2 btn btn-primary font-bold uppercase rounded-lg">{{__('Add to Cart')}}</button>
        </div> --}}
    </x-slot>
</x-jet-dialog-modal> 