
<div class="md:flex pb-8 px-4">
<div class="card bordered shadow-lg w-full rounded-box bg-base-200">
    <figure class="px-4 pt-4">
      {{-- <img src="https://picsum.photos/id/1005/400/250"> --}}
      <img src="{{$image}}" class="h-40 object-cover object-center rounded-box">
    </figure> 
    <div class="card-body h-30 px-5 pt-4 pb-0">
      <span class="menu-title">{{$brand}}</span>
      <h3 class="font-bold text-md">
          {{$title}}
      </h3> 
      <p class="text-sm mt-2">{{$product->description}}</p> 
    </div>
    <div class="pb-4 px-5 w-full flex justify-between card-actions">
        <h3 class="text-xl font-bold">
            ${{$product->price}}
        </h3>
        @if($product->real_stock>0)
        <button wire:click="addToCart({{$product->id}})" class="btn btn-primary m-0 rounded-lg">{{__('Add')}}</button>
        @else
        {{__('Sold Out')}}
        @endif
    </div>
</div> 
</div> 
