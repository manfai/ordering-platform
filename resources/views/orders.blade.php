<x-app-layout>
    <main class="bg-base-100">
        <div class="flex mt-8">
            @livewire('brand-list')
        </div>

        <div class="grid grid-cols-6 gap-4">

            <div class="left-side col-span-1 hidden lg:block">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    @livewire('sub-menu')
                </div>
            </div>
            <div class="right-side lg:col-span-5 col-span-6">
                <div class="flex justify-center mt-6 md:mt-0 py-8">
                    <div class="mx-auto container">
                        @livewire('order-list')
                        @livewire('hit-product')
                    </div>
                    @livewire('order-detail-card')
                </div>
            </div>

        </div>
    </main>
</x-app-layout>