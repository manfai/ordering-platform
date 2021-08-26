<div class="px-4 w-full">
    <div class="bg-base-200 w-full card shadow-lg rounded-box">

        <!-- <div class="px-4 pt-2">
            <img src="/img/adv.jpeg" class="w-full rounded-box">
        </div> -->
        <ul class="w-full menu py-4 px-4">
            <li class="menu-title">
                <span>
                    {{__('Menu Date')}}
                </span>
            </li>

            @foreach ($items as $item)

            @php
            $payload = serialize(['menu_date'=>$item->format("Y-m-d")]);
            @endphp

            <li class="flex justify-between text-sm">
                <a href="{{route('welcome')}}?menu={{base64_encode($payload)}}" class="flex justify-between">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 mr-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $item->format("Y-m-d") }}
                    </span>
                    <div class="text-xs badge ml-2 badge-neutral">0</div>
                </a>
                <!-- <a href="{{route('welcome')}}?menu={{base64_encode($payload)}}">
                {{ $item->format("Y-m-d") }}
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg> -->
            </li>
            @endforeach

        </ul>
    </div>

</div>