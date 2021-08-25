<div class=" pr-4">
    <div class="bg-base-200 card shadow-lg rounded-box">
        
    <div class="px-4 pt-2">
        <img src="/img/adv.jpeg" class="w-full rounded-box">
    </div>
    <ul class="w-full menu py-4 px-4">
    <li class="menu-title">
        <span>
            {{__('Product Catalogue')}}
            </span>
    </li> 

    @foreach ($items as $item)
    @php
        $payload = serialize(['tag'=>$item->id]);
    @endphp
    <li class="text-sm">
        <a href="{{route('welcome')}}?menu={{base64_encode($payload)}}">
            {{ ucfirst($item->name) }}
        </a>
    </li> 
    @endforeach

    </ul>
</div>

</div>