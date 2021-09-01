<div class="px-4 w-full">
    <div class="py-4 bg-base-200 w-full card shadow-lg rounded-box">

        <!-- <div class="px-4 pt-2">
            <img src="/img/adv.jpeg" class="w-full rounded-box">
        </div> -->
        <ul class="w-full menu">
            <li class="menu-title">
                <span>
                    {{__('Menu Date')}}
                </span>
            </li>

            @foreach ($items as $item)

            @php
                $menuDate = $item;
                //$menuDate = $item->format("Y-m-d");
                $payload = serialize(['menu_date'=>$menuDate]);
                if(Auth::user()){
                    $quantity = Auth::user()->cartItem()->where('menu_date',$menuDate)->sum('quantity');
                } else {
                    $quantity = 0;
                }
            @endphp

            <li class="flex justify-between @if($menu_date==$menuDate) bg-gray-300 @endif text-sm @if($quantity>0) text-red-500 @endif">
                <a href="{{route('welcome')}}?menu={{base64_encode($payload)}}" class="flex justify-between">
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
                        @endif

                        <code class="text-xs">{{ $menuDate }} ({{date('D',strtotime($menuDate))}})</code>
                    </span>
                    <div class="text-xs badge ml-2 badge-neutral">
                        {{$quantity}}
                    </div>
                </a>
              
            </li>
            @endforeach

        </ul>
    </div>

</div>