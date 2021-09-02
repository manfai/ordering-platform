{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div> --}}

<section class="flex flex-col md:flex-row h-screen items-center">

    <div class="bg-primary-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
      <img src="" alt="" class="w-full h-full object-cover">
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
