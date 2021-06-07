<x-jet-dialog-modal wire:model="addingToCart">

  <x-slot name="title">
      {{$title}}
  </x-slot>

  <x-slot name="content">
     
      <div class="flex">
          <div class="w-1/3 bg-cover" style="background-image: url('{{$image}}')">
          </div> 
          <div class="w-2/3 p-4 pt-0">
            {{-- <h1 class="text-gray-900 font-bold text-2xl">{{$title}}</h1> --}}
            <p class="mt-2 text-gray-600 text-sm">{{$description}}</p>
            <p><x-input.quantity wire:model="quantity" /></p>
            <div class="flex item-center mt-4">
              <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
              </svg>
              <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
              </svg>
              <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
              </svg>
              <svg class="w-5 h-5 fill-current text-gray-500" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
              </svg>
              <svg class="w-5 h-5 fill-current text-gray-500" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
              </svg>
            </div>
            
          </div>
      </div>
  </x-slot>

  <x-slot name="footer">
      <div class="flex item-center justify-between">
          <h1 class="text-gray-700 font-bold text-xl">${{$price}}</h1>
          <button wire:click="addToCart()" class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded">Add to Cart</button>
        </div>
      {{-- <x-jet-secondary-button wire:click="$toggle('addingToCart')" wire:loading.attr="disabled">
          Close
      </x-jet-secondary-button>

      <x-jet-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
          Add to cart
      </x-jet-button> --}}
  </x-slot>
  
</x-jet-dialog-modal>