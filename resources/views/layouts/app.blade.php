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

<body data-theme="cupcake" class="antialiased bg-base-100"> 
    
    <div class="relative flex justify-center min-h-screen sm:items-center pb-4 sm:pt-0 pb-6 px-4 lg:px-0">
        @if (Route::has('login'))
        <!-- <div class="hidden lg:block absolute top-0 right-0 px-8 py-4">
            @auth
            <a href="{{ url('/checkout') }}" class="text-sm mr-4 text-base-400">
            Cart
                {{-- <span class="inline-block px-4 py-1 text-center py-1 leading-none text-xs font-semibold text-gray-700 bg-base-300 rounded-full"> 
		</span> --}}
		@auth
		<span class="text-red-500">{{Auth::user()->cartItem()->sum('quantity')}}</span>
		@endauth
            </a>
            <a href="{{ url('/dashboard') }}" class="text-sm mr-4 text-gray-700">Profile</a>
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700">Orders</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
            @endauth
        </div> -->
             
        @endif
        <div class="w-full max-w-screen-2xl mx-auto sm:px-6 lg:px-12">
            <!-- <div class="hidden lg:flex justify-center pt-8 px-5 sm:justify-start sm:pt-0">
                <a href="/" class="py-8 px-4 bg-primary rounded-b-box">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-24" viewBox="0 0 248.59 132.84"><defs><style>.cls-1{fill:#fff;}</style></defs><path class="cls-1" d="M31.89,23.69H18.4v-9A16,16,0,0,0,18,9.76a1.85,1.85,0,0,0-1.9-1A2,2,0,0,0,13.94,10a18,18,0,0,0-.45,5.13V39.2a16.69,16.69,0,0,0,.45,4.93,1.92,1.92,0,0,0,2,1.16,1.89,1.89,0,0,0,2-1.16,18.78,18.78,0,0,0,.47-5.43V32.18H31.89v2q0,8.05-1.14,11.43a11.63,11.63,0,0,1-5,5.9,17.17,17.17,0,0,1-9.6,2.54,19.88,19.88,0,0,1-9.77-2.15A10.41,10.41,0,0,1,1.25,46Q0,42.19,0,34.55V19.39A68.83,68.83,0,0,1,.38,11a11.73,11.73,0,0,1,2.3-5.4A12.75,12.75,0,0,1,8,1.49,19.21,19.21,0,0,1,15.74,0a19.11,19.11,0,0,1,9.84,2.3,11.09,11.09,0,0,1,5.09,5.75q1.21,3.43,1.22,10.71Z"/><path class="cls-1" d="M67.56,31.47q0,7.83-.36,11.08a12.43,12.43,0,0,1-7.55,10.08A19.11,19.11,0,0,1,52,54.07a19.53,19.53,0,0,1-7.49-1.36,12.47,12.47,0,0,1-7.74-10,108.74,108.74,0,0,1-.38-11.22V22.6q0-7.83.36-11.08A12.43,12.43,0,0,1,44.26,1.44,19.13,19.13,0,0,1,52,0a19.51,19.51,0,0,1,7.48,1.36,12.47,12.47,0,0,1,7.74,10,108.87,108.87,0,0,1,.38,11.22Zm-13.49-17a16,16,0,0,0-.4-4.63,1.6,1.6,0,0,0-1.65-1,1.83,1.83,0,0,0-1.62.82c-.37.54-.56,2.15-.56,4.82V38.65a23.5,23.5,0,0,0,.37,5.58,1.6,1.6,0,0,0,1.71,1.06,1.67,1.67,0,0,0,1.77-1.22,26.2,26.2,0,0,0,.38-5.8Z"/><path class="cls-1" d="M114.23,1.09V53H102.44l0-35-4.7,35H89.36l-5-34.23,0,34.23H72.6V1.09H90.06q.76,4.68,1.6,11l1.91,13.2,3.1-24.23Z"/><path class="cls-1" d="M119.65,1.09h13.59a31.67,31.67,0,0,1,8.47.87,9.4,9.4,0,0,1,4.46,2.5,8.51,8.51,0,0,1,2,4,35.66,35.66,0,0,1,.53,7.2v4.52q0,5-1,7.24a7,7,0,0,1-3.76,3.5,17.9,17.9,0,0,1-7.17,1.21h-3.62V53H119.65ZM133.14,10v13.2c.38,0,.72,0,1,0a3.12,3.12,0,0,0,2.58-.92c.48-.61.73-1.87.73-3.8V14.23c0-1.77-.28-2.93-.84-3.46S134.89,10,133.14,10Z"/><path class="cls-1" d="M174.29,1.09,182,53H168.21l-.72-9.33h-4.83L161.85,53H147.9l6.88-51.89Zm-7.16,33.37q-1-8.82-2-21.8-2.07,14.91-2.59,21.8Z"/><path class="cls-1" d="M214.42,1.09V53H202.6l-7-23.59V53H184.29V1.09h11.29l7.56,23.37V1.09Z"/><path class="cls-1" d="M248.59,1.09,238.75,34.2V53h-12.5V34.2L216.76,1.09h12.4q2.9,15.2,3.27,20.45,1.13-8.31,3.76-20.45Z"/><path class="cls-1" d="M13.88,79.86v41.5h8.2v10.39H.38V79.86Z"/><path class="cls-1" d="M55.19,110.24q0,7.83-.37,11.08a12.39,12.39,0,0,1-7.54,10.08,19.16,19.16,0,0,1-7.7,1.44,19.51,19.51,0,0,1-7.48-1.36,12.47,12.47,0,0,1-7.74-10A108,108,0,0,1,24,110.24v-8.87c0-5.22.13-8.91.37-11.08a12.43,12.43,0,0,1,7.55-10.08,19.11,19.11,0,0,1,7.69-1.44,19.53,19.53,0,0,1,7.49,1.36,12.52,12.52,0,0,1,7.74,10,111.76,111.76,0,0,1,.38,11.22Zm-13.49-17a16.36,16.36,0,0,0-.4-4.63,1.6,1.6,0,0,0-1.65-1,1.83,1.83,0,0,0-1.62.82c-.38.54-.56,2.15-.56,4.82v24.23a23.56,23.56,0,0,0,.37,5.58,1.6,1.6,0,0,0,1.71,1.06,1.65,1.65,0,0,0,1.76-1.22,25.33,25.33,0,0,0,.39-5.8Z"/><path class="cls-1" d="M91.19,99H77.69V94.25a23.88,23.88,0,0,0-.38-5.58,1.72,1.72,0,0,0-1.83-1.12,1.7,1.7,0,0,0-1.7,1,15.64,15.64,0,0,0-.45,4.94v24.9a14.8,14.8,0,0,0,.45,4.6,1.75,1.75,0,0,0,1.8,1.11,2,2,0,0,0,2-1.25,14.72,14.72,0,0,0,.53-4.87v-6.16H75.38V103.9H91.19v27.85H82.71L81.46,128A9.46,9.46,0,0,1,78,131.64a9.82,9.82,0,0,1-5,1.2,12.86,12.86,0,0,1-6.36-1.65,12.16,12.16,0,0,1-4.51-4.09A12.94,12.94,0,0,1,60.22,122a62.73,62.73,0,0,1-.38-8V98.54a52,52,0,0,1,.8-10.8c.53-2.24,2.07-4.3,4.6-6.17a16.12,16.12,0,0,1,9.82-2.8,18.22,18.22,0,0,1,9.84,2.44A11.48,11.48,0,0,1,90,87a30.65,30.65,0,0,1,1.19,9.73Z"/><path class="cls-1" d="M127.24,110.24q0,7.83-.37,11.08a12.39,12.39,0,0,1-7.54,10.08,19.13,19.13,0,0,1-7.7,1.44,19.51,19.51,0,0,1-7.48-1.36,12.47,12.47,0,0,1-7.74-10A108.87,108.87,0,0,1,96,110.24v-8.87q0-7.83.36-11.08a12.43,12.43,0,0,1,7.55-10.08,19.11,19.11,0,0,1,7.69-1.44,19.53,19.53,0,0,1,7.49,1.36,12.52,12.52,0,0,1,7.74,10,108.74,108.74,0,0,1,.38,11.22Zm-13.49-17a16,16,0,0,0-.4-4.63,1.6,1.6,0,0,0-1.65-1,1.83,1.83,0,0,0-1.62.82c-.37.54-.56,2.15-.56,4.82v24.23a23.56,23.56,0,0,0,.37,5.58,1.61,1.61,0,0,0,1.71,1.06,1.67,1.67,0,0,0,1.77-1.22,26.2,26.2,0,0,0,.38-5.8Z"/></svg>
                </a>
            </div> -->
            <div class="navbar mb-2 pt-0 text-base-content rounded-box">
            <div class="hidden lg:flex flex-1 px-2 mx-2">
                <a href="/" class="py-8 px-4 bg-primary rounded-b-box">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-36" viewBox="0 0 248.59 132.84"><defs><style>.cls-1{fill:#fff;}</style></defs><path class="cls-1" d="M31.89,23.69H18.4v-9A16,16,0,0,0,18,9.76a1.85,1.85,0,0,0-1.9-1A2,2,0,0,0,13.94,10a18,18,0,0,0-.45,5.13V39.2a16.69,16.69,0,0,0,.45,4.93,1.92,1.92,0,0,0,2,1.16,1.89,1.89,0,0,0,2-1.16,18.78,18.78,0,0,0,.47-5.43V32.18H31.89v2q0,8.05-1.14,11.43a11.63,11.63,0,0,1-5,5.9,17.17,17.17,0,0,1-9.6,2.54,19.88,19.88,0,0,1-9.77-2.15A10.41,10.41,0,0,1,1.25,46Q0,42.19,0,34.55V19.39A68.83,68.83,0,0,1,.38,11a11.73,11.73,0,0,1,2.3-5.4A12.75,12.75,0,0,1,8,1.49,19.21,19.21,0,0,1,15.74,0a19.11,19.11,0,0,1,9.84,2.3,11.09,11.09,0,0,1,5.09,5.75q1.21,3.43,1.22,10.71Z"/><path class="cls-1" d="M67.56,31.47q0,7.83-.36,11.08a12.43,12.43,0,0,1-7.55,10.08A19.11,19.11,0,0,1,52,54.07a19.53,19.53,0,0,1-7.49-1.36,12.47,12.47,0,0,1-7.74-10,108.74,108.74,0,0,1-.38-11.22V22.6q0-7.83.36-11.08A12.43,12.43,0,0,1,44.26,1.44,19.13,19.13,0,0,1,52,0a19.51,19.51,0,0,1,7.48,1.36,12.47,12.47,0,0,1,7.74,10,108.87,108.87,0,0,1,.38,11.22Zm-13.49-17a16,16,0,0,0-.4-4.63,1.6,1.6,0,0,0-1.65-1,1.83,1.83,0,0,0-1.62.82c-.37.54-.56,2.15-.56,4.82V38.65a23.5,23.5,0,0,0,.37,5.58,1.6,1.6,0,0,0,1.71,1.06,1.67,1.67,0,0,0,1.77-1.22,26.2,26.2,0,0,0,.38-5.8Z"/><path class="cls-1" d="M114.23,1.09V53H102.44l0-35-4.7,35H89.36l-5-34.23,0,34.23H72.6V1.09H90.06q.76,4.68,1.6,11l1.91,13.2,3.1-24.23Z"/><path class="cls-1" d="M119.65,1.09h13.59a31.67,31.67,0,0,1,8.47.87,9.4,9.4,0,0,1,4.46,2.5,8.51,8.51,0,0,1,2,4,35.66,35.66,0,0,1,.53,7.2v4.52q0,5-1,7.24a7,7,0,0,1-3.76,3.5,17.9,17.9,0,0,1-7.17,1.21h-3.62V53H119.65ZM133.14,10v13.2c.38,0,.72,0,1,0a3.12,3.12,0,0,0,2.58-.92c.48-.61.73-1.87.73-3.8V14.23c0-1.77-.28-2.93-.84-3.46S134.89,10,133.14,10Z"/><path class="cls-1" d="M174.29,1.09,182,53H168.21l-.72-9.33h-4.83L161.85,53H147.9l6.88-51.89Zm-7.16,33.37q-1-8.82-2-21.8-2.07,14.91-2.59,21.8Z"/><path class="cls-1" d="M214.42,1.09V53H202.6l-7-23.59V53H184.29V1.09h11.29l7.56,23.37V1.09Z"/><path class="cls-1" d="M248.59,1.09,238.75,34.2V53h-12.5V34.2L216.76,1.09h12.4q2.9,15.2,3.27,20.45,1.13-8.31,3.76-20.45Z"/><path class="cls-1" d="M13.88,79.86v41.5h8.2v10.39H.38V79.86Z"/><path class="cls-1" d="M55.19,110.24q0,7.83-.37,11.08a12.39,12.39,0,0,1-7.54,10.08,19.16,19.16,0,0,1-7.7,1.44,19.51,19.51,0,0,1-7.48-1.36,12.47,12.47,0,0,1-7.74-10A108,108,0,0,1,24,110.24v-8.87c0-5.22.13-8.91.37-11.08a12.43,12.43,0,0,1,7.55-10.08,19.11,19.11,0,0,1,7.69-1.44,19.53,19.53,0,0,1,7.49,1.36,12.52,12.52,0,0,1,7.74,10,111.76,111.76,0,0,1,.38,11.22Zm-13.49-17a16.36,16.36,0,0,0-.4-4.63,1.6,1.6,0,0,0-1.65-1,1.83,1.83,0,0,0-1.62.82c-.38.54-.56,2.15-.56,4.82v24.23a23.56,23.56,0,0,0,.37,5.58,1.6,1.6,0,0,0,1.71,1.06,1.65,1.65,0,0,0,1.76-1.22,25.33,25.33,0,0,0,.39-5.8Z"/><path class="cls-1" d="M91.19,99H77.69V94.25a23.88,23.88,0,0,0-.38-5.58,1.72,1.72,0,0,0-1.83-1.12,1.7,1.7,0,0,0-1.7,1,15.64,15.64,0,0,0-.45,4.94v24.9a14.8,14.8,0,0,0,.45,4.6,1.75,1.75,0,0,0,1.8,1.11,2,2,0,0,0,2-1.25,14.72,14.72,0,0,0,.53-4.87v-6.16H75.38V103.9H91.19v27.85H82.71L81.46,128A9.46,9.46,0,0,1,78,131.64a9.82,9.82,0,0,1-5,1.2,12.86,12.86,0,0,1-6.36-1.65,12.16,12.16,0,0,1-4.51-4.09A12.94,12.94,0,0,1,60.22,122a62.73,62.73,0,0,1-.38-8V98.54a52,52,0,0,1,.8-10.8c.53-2.24,2.07-4.3,4.6-6.17a16.12,16.12,0,0,1,9.82-2.8,18.22,18.22,0,0,1,9.84,2.44A11.48,11.48,0,0,1,90,87a30.65,30.65,0,0,1,1.19,9.73Z"/><path class="cls-1" d="M127.24,110.24q0,7.83-.37,11.08a12.39,12.39,0,0,1-7.54,10.08,19.13,19.13,0,0,1-7.7,1.44,19.51,19.51,0,0,1-7.48-1.36,12.47,12.47,0,0,1-7.74-10A108.87,108.87,0,0,1,96,110.24v-8.87q0-7.83.36-11.08a12.43,12.43,0,0,1,7.55-10.08,19.11,19.11,0,0,1,7.69-1.44,19.53,19.53,0,0,1,7.49,1.36,12.52,12.52,0,0,1,7.74,10,108.74,108.74,0,0,1,.38,11.22Zm-13.49-17a16,16,0,0,0-.4-4.63,1.6,1.6,0,0,0-1.65-1,1.83,1.83,0,0,0-1.62.82c-.37.54-.56,2.15-.56,4.82v24.23a23.56,23.56,0,0,0,.37,5.58,1.61,1.61,0,0,0,1.71,1.06,1.67,1.67,0,0,0,1.77-1.22,26.2,26.2,0,0,0,.38-5.8Z"/></svg>
                    <!-- <svg xmlns="http://www.w3.org/2000/svg"  class="w-24" viewBox="0 0 807.14 466.85"><defs><style>.cls-1{fill:#fff;}</style></defs><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M.13,206.76V5.4H135.5v41H47.05V84.47h83.62v39H47.05v41.81h93.57v41.52Z"/><path class="cls-1" d="M317,203.21q-19.62,9-45.22,9a117.89,117.89,0,0,1-43.08-7.68,99.46,99.46,0,0,1-57-55.46q-8.25-19.62-8.25-43.23,0-24.17,8.39-43.8a97.45,97.45,0,0,1,23.18-33.42A102.78,102.78,0,0,1,229.64,7.4a124.32,124.32,0,0,1,84.9.14q20.61,7.53,33.41,22l-33,33a40.87,40.87,0,0,0-17.91-13.94,59.57,59.57,0,0,0-22.76-4.55,57.59,57.59,0,0,0-23.46,4.7,54.93,54.93,0,0,0-18.35,12.94A59,59,0,0,0,220.54,81.2a68.85,68.85,0,0,0-4.27,24.6,70.85,70.85,0,0,0,4.27,25,58.28,58.28,0,0,0,11.8,19.48A53.17,53.17,0,0,0,250.4,163a57.46,57.46,0,0,0,23,4.55q14.51,0,25.31-5.69A49,49,0,0,0,316.1,147l33.84,31.85A95.71,95.71,0,0,1,317,203.21Z"/><path class="cls-1" d="M182.59,466.85l1.14-142.49h-.86L130.54,466.85H96.41L45.51,324.36h-.86l1.14,142.49H0V265.49H69.2L115,394.61h1.14L160,265.49h70.34V466.85Z"/><path class="cls-1" d="M408.12,466.85l-15.64-39.53H314.55l-14.79,39.53h-52.9l84.47-201.36h47.21l83.62,201.36Zm-54-147.61-25.59,69.11h50.62Z"/><path class="cls-1" d="M586.73,466.85,543,386.93H526.43v79.92H478.94V265.49h76.79a133.29,133.29,0,0,1,28.29,3,73.76,73.76,0,0,1,24.75,10.1,52.91,52.91,0,0,1,17.49,18.77q6.54,11.67,6.54,29,0,20.47-11.09,34.41T591,380.67l52.62,86.18Zm-2-139.65q0-7.09-3-11.51a20.52,20.52,0,0,0-7.71-6.83,33.76,33.76,0,0,0-10.58-3.27,78.23,78.23,0,0,0-11.29-.85h-26v46.92H549.3a79.06,79.06,0,0,0,12.29-1A39.09,39.09,0,0,0,573,347.11a21.74,21.74,0,0,0,8.43-7.39Q584.73,334.89,584.74,327.2Z"/><path class="cls-1" d="M750.26,307V466.85H701.63V307H644.75V265.49H807.14V307Z"/></g></svg> -->
                </a>
            </div> 
            <div class="flex-none hidden px-2 mx-2 lg:flex">
                <div class="flex items-stretch">
                <a href="{{ url('/checkout') }}" class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">              
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
		    Cart
		   @auth
                    <span class="inline-block px-2 ml-2 py-1 text-center py-1 leading-none text-xs font-semibold text-gray-700 bg-base-300 rounded-full"> 
                    {{Auth::user()->cartItem()->sum('quantity')}}
		    </span>
		   @endauth
                </a> 
                <a href="{{route('orders')}}" class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">     
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Orders  
                </a> 
                <a class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">          
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    GIFTs
                </a> 
		<a 
		@auth
		href="{{route('profile')}}"
		@else
		href="{{route('login')}}"
		@endauth
		class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">       
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Profile
                </a>
                </div>
            </div> 
        </div>

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
                <a wire:click="checkoutNow()"  class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="tab tab-bentos block text-xs">{{__('Carts')}}</span>
                </a>
                <a href="{{route('orders')}}" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="tab tab-orders block text-xs">{{__('Orders')}}</span>
                </a>
		<a 
			
		@auth 
		href="{{route('profile')}}" 
		@else
		href="{{route('login')}}"
		@endauth
class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline-block mb-1 mt-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />                   
                    </svg>
                    @auth
                    <span class="tab tab-me block text-xs">{{__('Profile')}}</span>
                    @else
                    <span class="tab tab-me block text-xs">{{__('Login')}}</span>
                    @endauth
                </a>
            </div>
        </nav>
        
    </div>
    
    <x-footer />
    @stack('modals')
    @livewireScripts
    <script src="https://kit.fontawesome.com/eb7b3c2427.js" crossorigin="anonymous"></script>

</body>

</html>
