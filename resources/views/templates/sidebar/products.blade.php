
<aside>
    <h2 class="color-black text-center hidden-xs">Магазин</h2>
    <div class="product-sidebar">
        <h4 class="color-black">Категории</h4>
        @isset($categories)
            <ul>
                @foreach($categories as $category)
                    <li><button class="btn-link">{{ $category->title }} <span class="badge">{{ $category->products_count }}</span></button></li>
                @endforeach
            </ul>
        @endisset
    </div>
    <hr>
    <div class="product-sidebar">
        <h4 class="color-black">Бренд</h4>
        <ul>
            @foreach($products as $product)
                <li><button class="btn-link">{{ $product->brand->title }} <span class="badge">{{ $product->brand->products->count() }}</span></button></li>
            @endforeach
        </ul>
    </div>
    <hr>
</aside>