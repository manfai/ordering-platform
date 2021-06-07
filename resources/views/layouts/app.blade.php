<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EC Mart</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" id="topapp-font-css" href="https://fonts.googleapis.com/css?family=Poppins%3A300%2C400%2C500%2C600%2C700%2C900%7CRoboto%3A100%2C300%2C400%2C500%2C700%2C900&amp;display=swap&amp;ver=5.4.2" type="text/css" media="all">
    <!-- Styles -->
    {{-- <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0;
            font-family: "Poppins";
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }
        }
    </style> --}}
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@1.3.1/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.3.1/dist/themes.css" rel="stylesheet" type="text/css" /> --}}

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body data-theme="cupcake" class="antialiased">
   
    <div class="relative flex justify-center min-h-screen bg-base-100 sm:items-center py-4 sm:pt-0 pb-6">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/checkout') }}" class="text-sm mr-4 text-base-400">Cart
                <span class="inline-block px-4 py-1 text-center py-1 leading-none text-xs font-semibold text-gray-700 bg-base-300 rounded-full">{{Auth::user()->cartItem()->sum('quantity')}}</span>
            </a>
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif
        <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <a href="/" class="py-8 px-4 bg-primary rounded-b-box">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="w-24" viewBox="0 0 807.14 466.85"><defs><style>.cls-1{fill:#fff;}</style></defs><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M.13,206.76V5.4H135.5v41H47.05V84.47h83.62v39H47.05v41.81h93.57v41.52Z"/><path class="cls-1" d="M317,203.21q-19.62,9-45.22,9a117.89,117.89,0,0,1-43.08-7.68,99.46,99.46,0,0,1-57-55.46q-8.25-19.62-8.25-43.23,0-24.17,8.39-43.8a97.45,97.45,0,0,1,23.18-33.42A102.78,102.78,0,0,1,229.64,7.4a124.32,124.32,0,0,1,84.9.14q20.61,7.53,33.41,22l-33,33a40.87,40.87,0,0,0-17.91-13.94,59.57,59.57,0,0,0-22.76-4.55,57.59,57.59,0,0,0-23.46,4.7,54.93,54.93,0,0,0-18.35,12.94A59,59,0,0,0,220.54,81.2a68.85,68.85,0,0,0-4.27,24.6,70.85,70.85,0,0,0,4.27,25,58.28,58.28,0,0,0,11.8,19.48A53.17,53.17,0,0,0,250.4,163a57.46,57.46,0,0,0,23,4.55q14.51,0,25.31-5.69A49,49,0,0,0,316.1,147l33.84,31.85A95.71,95.71,0,0,1,317,203.21Z"/><path class="cls-1" d="M182.59,466.85l1.14-142.49h-.86L130.54,466.85H96.41L45.51,324.36h-.86l1.14,142.49H0V265.49H69.2L115,394.61h1.14L160,265.49h70.34V466.85Z"/><path class="cls-1" d="M408.12,466.85l-15.64-39.53H314.55l-14.79,39.53h-52.9l84.47-201.36h47.21l83.62,201.36Zm-54-147.61-25.59,69.11h50.62Z"/><path class="cls-1" d="M586.73,466.85,543,386.93H526.43v79.92H478.94V265.49h76.79a133.29,133.29,0,0,1,28.29,3,73.76,73.76,0,0,1,24.75,10.1,52.91,52.91,0,0,1,17.49,18.77q6.54,11.67,6.54,29,0,20.47-11.09,34.41T591,380.67l52.62,86.18Zm-2-139.65q0-7.09-3-11.51a20.52,20.52,0,0,0-7.71-6.83,33.76,33.76,0,0,0-10.58-3.27,78.23,78.23,0,0,0-11.29-.85h-26v46.92H549.3a79.06,79.06,0,0,0,12.29-1A39.09,39.09,0,0,0,573,347.11a21.74,21.74,0,0,0,8.43-7.39Q584.73,334.89,584.74,327.2Z"/><path class="cls-1" d="M750.26,307V466.85H701.63V307H644.75V265.49H807.14V307Z"/></g></svg>
                </a>
            </div>
            {{$slot}}
        </div>
    </div>
    
    {{-- <x-footer /> --}}
    @stack('modals')
    @livewireScripts
</body>

</html>