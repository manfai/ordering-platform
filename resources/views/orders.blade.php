<x-app-layout>
    <main class="bg-base-100">
        <div class="flex mt-8">
            @livewire('brand-list')
        </div>

        <div class="grid grid-cols-12 gap-4">

            <div class="left-side col-span-3 hidden lg:block">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    <!-- @livewire('sub-menu') -->

                    <div class="card text-center shadow-2xl">
                        <figure class="px-10 pt-10">
                            <img src="https://picsum.photos/id/1005/400/250" class="rounded-xl">
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{auth()->user()->name}}</h2>
                            <p>EC Point: {{auth()->user()->balance}}</p>
                            <div class="justify-center card-actions">
                                <button class="btn btn-outline btn-accent">{{__('Log Out')}}</button>
                            </div>
                        </div>
                    </div>


                </div>

                <h3 class="mb-5 text-xl font-bold text-gray-400">
                        {{__('Your Coupons')}}
                        <span class="float-right"><a href="" class="link"><small>{{__('History')}}</small></a></span>
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    
                        @foreach(auth()->user()->coupons()->where('expired_at','>=',date('Y-m-d H:i:s'))->where('status','available')->get() as $coupon)
                        <!-- <div class="col-span-1">
                            <div class="card shadow-2xl lg:card-side bg-primary text-primary-content">
                                <div class="card-body">
                                    <p>Rerum reiciendis beatae tenetur excepturi aut pariatur est eos.</p>
                                </div>
                            </div>
                        </div> -->
                        <div class="card card-side bordered">
                            <figure style="max-width:100px">
                                <img src="https://picsum.photos/id/1005/100/100">
                            </figure> 
                            <div class="card-body p-3">
                                <h2 class="card-title">${{$coupon->coupon->value}}</h2> 
                                <p><small>{{__('Expired At')}}: {{$coupon->expired_at}}</small></p> 
                                <!-- <div class="card-actions">
                                <button class="btn btn-primary">Get Started</button> 
                                <button class="btn btn-ghost">More info</button> -->
                                <!-- </div> -->
                            </div>
                        </div> 
                       @endforeach
                </div>

                <h3 class="mt-5 mb-5 text-xl font-bold text-gray-400">
                        {{__('Gifts')}}
                    <span class="float-right"><a href="" class="link"><small>{{__('Yours Gift')}}</small></a></span>
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    
                        @foreach(auth()->user()->coupons()->where('expired_at','>=',date('Y-m-d H:i:s'))->where('status','available')->get() as $coupon)
                        <!-- <div class="col-span-1">
                            <div class="card shadow-2xl lg:card-side bg-primary text-primary-content">
                                <div class="card-body">
                                    <p>Rerum reiciendis beatae tenetur excepturi aut pariatur est eos.</p>
                                </div>
                            </div>
                        </div> -->
                        <div class="card card-side bordered">
                            <figure style="max-width:100px">
                                <img src="https://picsum.photos/id/1005/100/100">
                            </figure> 
                            <div class="card-body p-3">
                                <h2 class="card-title">${{$coupon->coupon->value}}</h2> 
                                <p><small>{{__('Expired At')}}: {{$coupon->expired_at}}</small></p> 
                                <!-- <div class="card-actions">
                                <button class="btn btn-primary">Get Started</button> 
                                <button class="btn btn-ghost">More info</button> -->
                                <!-- </div> -->
                            </div>
                        </div> 
                       @endforeach
                </div>

            </div>
            <div class="right-side lg:col-span-9 col-span-12">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    <div class="mx-auto container">
                        @livewire('order-list')
                    </div>
                    @livewire('order-detail-card')
                </div>
            </div>

            <div class="col-span-12">
            @livewire('hit-product')

            </div>
        </div>
    </main>
</x-app-layout>