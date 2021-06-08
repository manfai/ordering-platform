
<div>
    <!-- Remove py-8 -->
    <div wire:poll class="mx-auto container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 auto-cols-max">
            @foreach ($products as $product)
                @livewire('product-card', ['product' => $product, 'brand' => $brand])
            @endforeach
            @livewire('add-cart')
            <div class="col-span-3">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
