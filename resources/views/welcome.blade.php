<x-app-layout> 
    <div class="flex mt-8">
       @livewire('brand-list')
    </div>
 
    
    <main>
        <div class="grid grid-cols-6 gap-4">

            <div class="left-side col-span-1 hidden lg:block">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    <div class="py-4 artboard artboard-demo bg-base-200 shadow-lg rounded-box">
                        <ul class="w-full menu py-4 px-4">
                        <li class="menu-title">
                            <span>
                                {{__('Menu Title')}}
                                </span>
                        </li> 

                        @foreach (\Spatie\Tags\Tag::where('type','preferences')->get()->take(11) as $item)
                        <li>
                            <a>
                                {{ ucfirst($item->name) }}
                            </a>
                        </li> 
                        @endforeach

                        </ul>
                    </div>
      
                </div>
            </div>
            <div class="right-side lg:col-span-5 col-span-6">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    @livewire('product-list')
                </div>
            </div>

        </div>


    </main>
    
</x-app-layout>