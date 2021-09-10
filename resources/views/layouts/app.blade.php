<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" id="topapp-font-css" href="https://fonts.googleapis.com/css?family=Poppins%3A300%2C400%2C500%2C600%2C700%2C900%7CRoboto%3A100%2C300%2C400%2C500%2C700%2C900&amp;display=swap&amp;ver=5.4.2" type="text/css" media="all">
    <!-- Styles -->
  
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/themes.css" rel="stylesheet" type="text/css" /> -->

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7410177851675505" crossorigin="anonymous"></script>
</head>

<body data-theme="dsc" class="antialiased bg-base-100">

    <div class="text-base-content relative flex justify-center min-h-screen sm:items-center sm:pt-0 px-4 lg:px-0">

        <div class="w-full max-w-screen-2xl mx-auto px-0 lg:px-12">
            @if (Route::has('login'))
            <div class="navbar mb-2 pt-0 text-base-content rounded-box">
                <div class="flex flex-1 lg:px-2 lg:mx-2">
                    <div class="w-64 pt-0 mt-0">
                        <x-jet-authentication-card-logo />
                    </div>
                </div>
                <div class="flex-none hidden px-2 mx-2 lg:flex">
                    <div class="flex items-stretch">
                        <a href="{{ url('/checkout') }}" class="btn btn-primary btn-sm rounded-btn mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Checkout
                            @auth
                            @livewire('cart-count')
                            @endauth
                        </a>
                        @auth
                        <a href="{{route('profile')}}" class="btn btn-ghost btn-sm rounded-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="btn btn-ghost btn-sm rounded-btn">
                            <svg xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{__('Log Out')}}</a>
                        </form>
                        @else
                        <a href="{{route('login')}}" class="btn btn-ghost btn-sm rounded-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Login
                        </a>
                        @endauth


                    </div>
                </div>
            </div>
            @endif
            
            {{$slot}}

        </div>

        <nav id="mobile-menu" id="bottom-navigation" class="block lg:hidden fixed inset-x-0 bottom-0 z-10 bg-white shadow">
            <div id="tabs" class="flex justify-between">
                <a href="{{route('welcome')}}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="tab tab-products block text-xs">{{__('Products')}}</span>
                </a>
                <a href="{{route('checkout')}}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="tab tab-bentos block text-xs">{{__('Checkout')}}</span>
                </a>
                <a href="{{route('orders')}}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="tab tab-orders block text-xs">{{__('Orders')}}</span>
                </a>

                @auth
                <a href="{{route('profile')}}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="tab tab-me block text-xs">{{__('Profile')}}</span>
                </a>
                @else
                <a href="{{route('login')}}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="tab tab-me block text-xs">{{__('Login')}}</span>
                </a>
                @endauth

            </div>
        </nav>


      
    </div>

    <x-footer />
    @stack('modals')
    @livewireScripts
    <script src="https://kit.fontawesome.com/eb7b3c2427.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollto@2.1.3/jquery.scrollTo.min.js"></script>
    @stack('scripts')

</body>

</html>