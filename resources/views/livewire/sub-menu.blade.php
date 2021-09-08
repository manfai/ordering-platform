<div class="w-full">


    @livewire('user-notify')

    <div class="py-4 bg-base-200 text-base-content w-full card shadow-lg rounded-box mb-8">

        <ul class="w-full menu">
            <li class="menu-title">
                <span>
                    {{__('Menu Date')}}
                </span>
            </li>

            @foreach ($items as $item)

            @php
            if($item<=date('Y-m-d')){ continue; } $menuDate=$item; //$menuDate=$item->format("Y-m-d");
                $payload = serialize(['menu_date'=>$menuDate]);
                if(Auth::user()){
                $quantity = Auth::user()->cartItem()->where('menu_date',$menuDate)->sum('quantity');
                } else {
                $quantity = 0;
                }
                @endphp

                <li class="flex justify-between @if($menu_date==$menuDate) bg-gray-200 @endif text-sm @if($quantity>0) text-secondary @endif">
                    <a href="?menu={{base64_encode($payload)}}" class="flex justify-between">
                        <span>
                            @php
                            if(Auth::user()){
                            $orders = auth()->user()->bentos()->where([
                            'menu_date'=>$menuDate,
                            'status' => 'paid'
                            ])->exists();
                            } else {
                            $orders = false;
                            }

                            @endphp
                            @if(!$orders)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-block w-5 h-5 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-block w-5 h-5 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg> -->
                            @endif

                            <code class="text-xs">{{ $menuDate }} ({{date('D',strtotime($menuDate))}})</code>
                        </span>
                        <div class="text-xs badge ml-2 badge-secondary">
                            {{$quantity}}
                        </div>
                    </a>

                </li>
                @endforeach

        </ul>
    </div>


    <div class="py-4 rounded-box">
        <ul class="menu w-full text-gray-600">
            <li class="menu-title">
                <span>
                    Instructions
                </span>
            </li>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-1 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    = Ordered
                </a>
            </li>
            <li>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-1 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    = Normal Status *No order
                </a>
            </li>
            <li>
                <a>
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-1 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg> -->
                    <!-- <span class="h-5 w-5 mr-1 bg-blue-400"></span> -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-1 stroke-current text-secondary">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    = Products in cart
                </a>
            </li>
        </ul>
    </div>

</div>