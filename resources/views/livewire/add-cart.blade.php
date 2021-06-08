<x-jet-dialog-modal wire:model="addingToCart">

  <x-slot name="title">
      {{-- {{$title}} --}}
      Product Detail
  </x-slot>

  <x-slot name="content">
     
      <div class="flex h-56">
          <div class="w-1/3 bg-cover" style="background-image: url('{{$image}}')">
          </div> 
          <div class="w-2/3 p-4 pt-0">
            <h1 class="text-gray-900 font-bold text-2xl">{{$title}}</h1>
            <p class="mt-2 text-gray-600 text-sm">{{$description}}</p>
            <p><x-input.quantity wire:model="quantity" /></p>            
          </div>
      </div>
  </x-slot>

  <x-slot name="footer">
      <div class="flex item-center justify-between">
          <h1 class="text-gray-700 font-bold text-3xl pt-2">${{$price}}</h1>
          <button wire:click="addToCart()" class="px-3 py-2 btn btn-primary font-bold uppercase rounded">Add to Cart</button>
        </div>
      {{-- <x-jet-secondary-button wire:click="$toggle('addingToCart')" wire:loading.attr="disabled">
          Close
      </x-jet-secondary-button>

      <x-jet-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
          Add to cart
      </x-jet-button> --}}
  </x-slot>
  
</x-jet-dialog-modal>