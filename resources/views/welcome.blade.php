<x-app-layout> 

    <main class="w-full mb-10">
        <div class="grid grid-cols-12">

            <div class="left-side col-span-12 lg:col-span-3 hidden lg:block">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                   @livewire('sub-menu',['filter'=>isset($_GET['menu'])?$_GET['menu']:null])
                </div>
            </div>
            <div class="right-side lg:col-span-9 col-span-12">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    @livewire('product-list',['filter'=>isset($_GET['menu'])?$_GET['menu']:null])
                </div>
            </div>

        </div>
    </main>
    
    @if(session()->has('message'))  
    <div on="saved" class="alert fixed top-12 right-12 z-20 opacity-85 shadow-lg text-base-content">
    <div class="flex-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="animate-pulse stroke-current text-success flex-shrink-0 w-6 h-6 mx-2">     
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
        </svg>
        <label>
            <h4 class="px-3"> {{ session('message') }}</h4>
        </label>
    </div> 
    </div>
    @endif
</x-app-layout>
