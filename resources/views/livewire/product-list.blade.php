
<div>
    <!-- Remove py-8 -->
    <div class="mx-auto container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 auto-cols-max">
            @foreach ($products as $product)
                <livewire:product-card :product="$product">
            @endforeach
            @livewire('add-cart')
        </div>
    </div>
</div>
