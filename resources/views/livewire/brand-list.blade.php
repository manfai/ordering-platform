<div class="hidden w-full navbar shadow-lg py-4 text-base-content bg-base-200 rounded-box">
  <div class="flex-1 px-2 mx-2 mt-1">
    <!-- <div class="items-stretch hidden lg:flex">
      <a class="rounded-sm btn btn-ghost mr-4" wire:click="$emitTo('product-list','brandUpdate','ec_mart')">
        <h4 class="font-bold text-lg">EC Mart</h4>
      </a> 
      <a class="rounded-sm btn btn-ghost mr-4" wire:click="$emitTo('product-list','brandUpdate','ec_bento')">
        <h4 class="font-bold text-lg">EC Bento</h4>
      </a> 
    </div> -->
  </div> 
  <!-- <div class="flex-none">
    <button class="btn btn-square btn-ghost">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
      </svg>
    </button>
  </div>  -->
  <div class="flex-none">
   @auth
   <a wire:click="checkoutNow()" class="btn btn-square btn-ghost">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
      </svg>
    </a>
   @endauth
  </div>
  <div class="flex-none">
      @guest
      <a href="{{route('login')}}">
      <h4 class="mr-4">{{__('Login')}}</h4>
      </a>
      <a href="{{route('login')}}">
      <h4 class="mr-4">{{__('Register')}}</h4>
      </a>
      <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path strokeLinecap="round" strokeLinejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
      </svg> -->
      @else
      <a href="{{route('orders')}}">
      <div class="avatar">
          <div class="mx-4 w-8 h-8 mt-2 mask mask-squircle">
            <img src="{{asset('/img/profile.png')}}">
          </div>
        </div> 
      @endguest
        
      </a>
  </div>
</div>