
<aside>
    <h2 class="color-black text-center hidden-xs">Магазин</h2>
    <div class="product-sidebar">
        <h4 class="color-black">Категории</h4>
        @isset($categories)
            <ul>
                @foreach($categories as $category)
                    <li><a href="{{ route('products.category', ['parent_category' => $category->menu->alias, 'category' => $category->alias]) }}" class="btn-link">{{ $category->title }} <span class="badge">{{ $category->products_count }}</span></a></li>
                @endforeach
            </ul>
        @endisset
    </div>
    <hr>
    <div class="product-sidebar">
        <h4 class="color-black">Бренд</h4>
        @isset($menu)
            <ul>
                @foreach($menu->products as $product)
                    <li><a class="btn-link">{{ $product->brand->title }} <span class="badge">{{ $product->brand->products->count() }}</span></a></li>
                @endforeach
            </ul>
        @endisset
    </div>
    <hr>
</aside>