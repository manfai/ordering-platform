<div>
    <div class="w-auto bg-base-200 card rounded-lg shadow-lg border-solid border-gray-500">
        <div class="pt-4 bg-primary px-2 py-2 text-primary-content text-bold pb-4 border-b text-xl text-center">
            {{date('M Y')}}
        </div>
        <div class="pb-4">
            <table class="w-full">
                <tr class="border-b">
                    <th class="py-3 px-2">S</th>
                    <th class="py-3 px-2">M</th>
                    <th class="py-3 px-2">T</th>
                    <th class="py-3 px-2">W</th>
                    <th class="py-3 px-2">T</th>
                    <th class="py-3 px-2">F</th>
                    <th class="py-3 px-2">S</th>
                </tr>
                <tr>

                    @foreach($period[0] as $index => $date)
                    @php
                    $d = $date->format('j');
                    $menu_date = $date->format('Y-m-d');
                    $payload = serialize(['menu_date'=>$menu_date]);

                    $hasMenu = in_array($menu_date,config('menu.date'));
                    $hasOrder = in_array($menu_date,$ordered);
                    @endphp

                    @if($index==0)
                    @for($s = 0; $s < $date->format('N'); $s++)
                        <td></td>

                        @endfor

                        @if($date->format('N')==7)
                </tr>
                <tr>
                    <td class="text-center">
                        <a class="text-gray-400">{{$d}}
                        </a>
                    </td>
                    @else
                    <td class="text-center">

                        @if($hasMenu)
                        <a href="/?menu={{base64_encode($payload)}}" class="{{$hasOrder?'font-bold rounded-full text-info underline':'hover:text-primary'}} indicator">{{$d}}
                        </a>
                        @else
                        <a class="text-gray-400 {{$hasOrder?'font-bold rounded-full text-info underline':'hover:text-primary'}}">{{$d}}
                        </a>
                        @endif
                    </td>
                    @endif

                    @else

                    @if($date->format('N')==7)
                </tr>
                <tr>
                    <td class="text-center">
                        <a class="text-gray-400">{{$d}}
                        </a>
                    </td>
                    @elseif($date->format('N')==6)
                    <td class="text-center">
                        <a class="text-gray-400">{{$d}}
                        </a>
                    </td>
                    @else
                    <td class="text-center">
                        @if($hasMenu)
                        <a href="/?menu={{base64_encode($payload)}}" class="{{$hasOrder?'font-bold rounded-full text-info underline':'hover:text-primary'}} indicator">
                        @else
                        <a class="text-gray-400 {{$hasOrder?'font-bold rounded-full text-info underline':'hover:text-primary'}} indicator">
                        @endif

                        {{$d}}
                            <!-- <div class="indicator-item indicator-center indicator-middle bg-info">*</div>  -->
                        </a>

                    </td>
                    @endif

                    @endif



                    @endforeach

            </table>
        </div>
    </div>
</div>