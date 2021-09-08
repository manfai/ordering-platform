<x-app-layout>

    <main class="w-full mb-10">

        <div class="px-2 mx-2 mt-10 grid grid-cols-12 gap-6">

            <div class="left-side col-span-12 lg:col-span-3">
                @livewire('user-card')

                @livewire('user-notify')




            </div>

            <div class="right-side lg:col-span-9 col-span-12">
                <div class="flex justify-center mt-6 md:mt-0 pb-8">
                    <div class="mx-auto container">
                        @livewire('order-list')
                    </div>
                </div>
            </div>


        </div>
    </main>
</x-app-layout>