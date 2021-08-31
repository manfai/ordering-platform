<x-app-layout>
    <main class="bg-base-100">

        <div class=" px-2 mx-2 grid grid-cols-12 gap-4">

            <div class="left-side col-span-12 lg:col-span-3">
                <div class="flex bg-base-200 rounded-2xl mb-6 justify-center mt-6 md:mt-0">

                    <div class="card text-center pt-8">
                        <div class="avatar online m-auto">
                            <div class="w-24 h-24 mask mask-squircle">
                                <img src="http://daisyui.com/tailwind-css-component-profile-1@94w.png">
                            </div>
                        </div> 
                        <div class="card-body">
                            <h2 class="card-title">{{auth()->user()->name}}</h2>
                            <!-- <p>EC Point: {{auth()->user()}}</p> -->
                            <div class="justify-center card-actions p-0">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="btn btn-sm btn-outline btn-accent">{{__('Log Out')}}</a>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="block rounded-lg shadow-lg overflow-hidden bg-white text-center w-full">
                    <div class="text-xl bg-red-500 text-white py-1">
                        {{date('M')}}
                    </div>
                    <div class="pt-5 pb-5 border-l border-r">
                        <h2 class="text-3xl font-bold">{{date('d')}}</h2>
                    </div>
                    <div class="pb-2 px-2 border-l border-r border-b rounded-lg bottom-0 flex justify-between">
                          <h3 class="text-xl font-bold">{{date('D')}}</h3>
                          <h3 class="text-xl font-bold">{{date('Y')}}</h3>
                    </div>
                </div>

{{-- 
                <h3 class="mb-5 text-xl font-bold text-gray-400">
                        {{__('Your Coupons')}}
                        <span class="float-right"><a href="" class="link"><small>{{__('History')}}</small></a></span>
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    
                        @foreach(auth()->user()->coupons()->where('expired_at','>=',date('Y-m-d H:i:s'))->where('status','available')->get()->take(3) as $coupon)
                        <div class="card card-side bordered">
                            <figure style="max-width:100px">
                                <img src="https://ecbento.com/2.0/wp-content/uploads/2020/08/logo-2.png">
                            </figure> 
                            <div class="card-body p-3">
                                <h2 class="card-title text-3xl">${{$coupon->coupon->value}}</h2> 
                                <p><small>{{__('Expired At')}}: {{$coupon->expired_at}}</small></p> 
                            </div>
                        </div> 
                       @endforeach
                </div> --}}

                <!-- @php $coupons = auth()->user()->coupons()->where('expired_at','>=',date('Y-m-d H:i:s'))->where('status','available')->get() @endphp
                @if(count($coupons))
                <h3 class="mt-5 mb-5 text-xl font-bold text-gray-400">
                        {{__('Gifts')}}
                    <span class="float-right"><a href="" class="link"><small>{{__('Yours Gift')}}</small></a></span>
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    @foreach($coupons as $coupon)
                        <div class="card card-side bordered">
                            <figure style="max-width:100px">
                                <img src="https://picsum.photos/id/1005/100/100">
                            </figure> 
                            <div class="card-body p-3">
                                <h2 class="card-title">${{$coupon->coupon->value}}</h2> 
                                <p><small>{{__('Expired At')}}: {{$coupon->expired_at}}</small></p> 
                            </div>
                        </div> 
                    @endforeach
                </div>
                @endif -->

            </div>
            <div class="right-side lg:col-span-9 col-span-12">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    <div class="mx-auto container">
                        @livewire('order-list')
                    </div>
                    @livewire('order-detail-card')
                </div>
            </div>

           
        </div>
    </main>
</x-app-layout>