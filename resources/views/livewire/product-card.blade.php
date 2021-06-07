
<div class="md:flex pb-8 px-4">
<div class="card bordered shadow-lg rounded-box bg-base-200">
    <figure>
      {{-- <img src="https://picsum.photos/id/1005/400/250"> --}}
      <img src="{{$product->image}}" class="h-40 object-cover object-top">
    </figure> 
    <div class="card-body h-30 px-4 pt-4 pb-0">
      <h3 class="font-bold text-md">
          {{$product->title}}
      </h3> 
      <p class="text-sm mt-2">{{$product->description}}</p> 
    </div>
    <div class="pb-4 pr-4 w-full flex justify-between card-actions">
        <h3 class="pl-4 text-xl font-bold">
            ${{$product->price}}
        </h3>
        <button wire:click="addToCart({{$product->id}})" class="btn btn-dark btn-xs">Add to cart</button>
    </div>
</div> 
</div> 
