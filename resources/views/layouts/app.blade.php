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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
 
</head>

<body data-theme="mytheme" class="antialiased bg-base-100"> 
    
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
                <!-- <a href="/" class="pb-8 pt-4 px-4 rounded-b-box">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-36" viewBox="0 0 250.15 178.7">
                        <path d="M0,177.77V74.46H1.4c9.43,0,18.87.09,28.3,0,12.16-.15,21,5.27,27,15.65A36.72,36.72,0,0,1,62,108.6c0,10,.23,20,.14,30,0,5.22-.16,10.53-1.87,15.52-3.61,10.53-10.12,18.52-20.9,22.33a24.91,24.91,0,0,1-7.86,1.35c-10.27.16-20.54.08-30.81.09C.53,177.84.34,177.8,0,177.77ZM13.36,163a2.74,2.74,0,0,0,.45.1c5.55,0,11.11.11,16.66,0a17,17,0,0,0,13.25-6.15c3.66-4.4,5-9.55,5.06-15.12q.07-15.21,0-30.42c0-5.19-1.15-10.07-4.3-14.43-3.69-5.11-8.48-7.82-14.8-7.82H13.36Z"/><path d="M66.65,164.57c.34-.48.63-.9.94-1.31l7.69-10.33c1.75,1.38,3.36,2.82,5.14,4,8.23,5.48,17.2,7.54,26.91,5.3,8.31-1.91,11.1-8.23,10.43-15.65-.72-8.07-6.28-10.89-12.24-12-5.29-1-10.7-1.6-15.8-3.19-10.21-3.19-15.93-10.7-17.83-21-1.4-7.66-.78-15.23,2.81-22.3A24.84,24.84,0,0,1,95,74c12.23-1.42,23.12,2,32.76,9.59.5.39.86.7.42,1.45-2.28,3.85-4.5,7.73-6.74,11.59a3.11,3.11,0,0,1-.33.43c-1-.71-2-1.42-3.07-2.08A34.65,34.65,0,0,0,99.45,89.2c-5.59-.07-10.43,1.85-13,7.09s-2.8,10.46.84,15.38c2.61,3.54,6.46,4.93,10.59,5.7s8.61,1.29,12.83,2.32c11,2.68,17.16,10.16,19.61,20.82a36,36,0,0,1-2.66,24.29c-3.44,7.07-9.45,11.07-16.94,12.67C94,181,79.37,177,67,165A5.08,5.08,0,0,1,66.65,164.57Z"/><path d="M200.86,149c-1.69,7.92-4.38,15.16-10,21a27.26,27.26,0,0,1-22.6,8.62c-13.57-1.09-22-9-27.08-21.12a36.2,36.2,0,0,1-2.39-13.24c-.19-10.22-.29-20.45-.23-30.67,0-5.62.11-11.31,1.9-16.71,3.57-10.72,10.17-18.84,21.3-22,12-3.45,24.65.08,32.61,12.31a43.6,43.6,0,0,1,6.47,17h-14c-.78-1.83-1.43-3.69-2.33-5.41-2.49-4.74-6.1-8.18-11.57-9.18-6.38-1.17-11.61.92-15.8,5.81a20.74,20.74,0,0,0-4.76,12.16,236.2,236.2,0,0,0-.17,35.19,32.08,32.08,0,0,0,1.44,8,17.44,17.44,0,0,0,12.25,12c6.46,1.82,12.72-.62,16.8-6.33a73.62,73.62,0,0,0,3.64-6.44c.19-.33.55-.8.83-.81C191.71,149,196.22,149,200.86,149Z"/><path class="cls-1" style="fill:#c61a27;" d="M238.86,71.24l11.29,5.29c-.39.35-.67.62-1,.86Q232.55,90.86,215.9,104.3a1.45,1.45,0,0,0-.51,2c1.53,4.07,3,8.17,4.46,12.26.13.37.25.74.44,1.32H194.16v21.35h-7.44V111.89h22.17c-.6-1.69-1.14-3.18-1.68-4.67-1.21-3.36-.56-5.71,2.22-8l24.68-20c.31-.25.6-.51,1-.85l-1.1-.6a6.1,6.1,0,0,1-3.23-7.63c1.15-3.65,2.36-7.29,3.53-10.93.12-.37.23-.75.39-1.33l-7,1.45-3.63.78a6.23,6.23,0,0,1-7.66-3.9c-.28-.65-.57-1.29-.92-2.09l-3.39,3.61Q209,61.07,206,64.36a6.25,6.25,0,0,1-7.6,1.63c-2.57-1.27-3.81-3.92-3.21-7.07,1.36-7.13,2.76-14.25,4.15-21.38l.87-4.51c-1.06.6-1.91,1.07-2.74,1.55-3.76,2.15-7.38,1.09-9.34-2.74q-3.3-6.45-6.59-12.9c-.18-.35-.37-.69-.65-1.2-.29.53-.49.9-.68,1.28l-6.52,12.8c-2,3.84-5.6,4.92-9.34,2.78L161.55,33c1.31,6.77,2.55,13.24,3.86,20-.52-.5-.84-.78-1.14-1.08-2.75-2.73-5.52-5.44-8.25-8.2a3.16,3.16,0,0,1-.84-1.5c-1.58-8-3.11-15.9-4.65-23.85-.05-.3-.07-.61-.13-1.1L167.13,27,180.86,0,194.6,27l16.81-9.7L204.28,54l.24.13,13.53-14.5c1.57,3.68,3.07,7.24,4.6,10.79.84,1.93.33,1.74,2.46,1.3l20.25-4.3c.38-.08.77-.12,1.3-.2C244,55.29,241.47,63.2,238.86,71.24Z"/><path class="cls-1" style="fill:#c61a27;" d="M145.39,54.17l-1.12,2.56a6.19,6.19,0,0,1-7.35,3.7l-10.07-2.24c.91,5.74,1.8,11.3,2.71,17l-.88-.49c-2.37-1.32-4.76-2.6-7.1-4a2.18,2.18,0,0,1-1-1.26c-1.15-6.8-2.24-13.62-3.33-20.43,0-.35,0-.7-.08-1.23,2.07.45,4,.86,6,1.3,4.4,1,8.8,2,13.2,3a1.11,1.11,0,0,0,1.53-.78c1.35-3.33,2.79-6.62,4.19-9.92.17-.4.35-.79.66-1.49L168,65.9a31.69,31.69,0,0,0-5.95.94c-2.47.82-4,.07-5.62-1.72-3.2-3.45-6.66-6.67-10-10C146.12,54.86,145.83,54.59,145.39,54.17Z"/>
                    </svg>
                </a> -->
                <div class="w-64 pt-0 mt-0">
                    <x-jet-authentication-card-logo />
                </div>
            </div> 
            <div class="flex-none hidden px-2 mx-2 lg:flex">
                <div class="flex items-stretch">
                <a href="{{ url('/checkout') }}" class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">              
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
		    Cart
            @auth
                    @livewire('cart-count')
                    
            @endauth
                </a> 
                <!-- <a href="{{route('orders')}}" class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">     
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Orders  
                </a>  -->
                <!-- <a class="btn btn-ghost btn-sm rounded-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 mr-2 stroke-current">          
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    GIFTs
                </a>  -->
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
                        
                        @auth
                        Profile
                        @else
                        Login
                        @endauth
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
    {{-- @stack('scripts') --}}

</body>

</html>
