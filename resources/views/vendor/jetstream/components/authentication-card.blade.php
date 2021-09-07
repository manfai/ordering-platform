{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div> --}}

<section class="flex flex-col md:flex-row h-screen items-center">

    <div class="bg-primary bg-bottom bg-cover hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen" style="background-image: url(&quot;/img/food.jpg&quot;);">
      <div class="hero-overlay bg-opacity-60"></div>
      <div class="fixed bottom-0 left-0 z-1">
        <p class="text-xs text-gray-300 px-3 py-1">Copyright © {{date('Y')}} - All right reserved by {{config('app.company')}}</p>
      </div>
      <!-- <img src="/img/20190810-EC-BENTO-%E6%96%B0%E5%AE%A2%E6%88%B6%E8%A8%82%E9%A4%90-%E4%BA%AB-30-%E6%8A%98%E6%89%A3%E5%84%AA%E6%83%A0.jpg" alt="" class="w-full h-full object-cover"> -->
    </div>
  
    <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">
  
      <div class="w-full h-100">
  
        <div>
            {{ $logo }}
        </div>

        {{ $slot }}
  
      </div>
    </div>
  
  </section>
