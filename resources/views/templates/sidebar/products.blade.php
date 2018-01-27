
<aside>
    <h2 class="color-black text-center hidden-xs">Магазин</h2>
    <div class="product-sidebar">
        <h4 class="color-black">Категории</h4>
        <ul>
            @if(isset($categories))
                @foreach($categories as $category)
                    <li><a href="{{ route('products.category', ['parent_category' => $category->menu->alias, 'category' => $category->alias]) }}" class="btn-link">{{ $category->title }} <span class="badge">{{ $category->products_count }}</span></a></li>
                @endforeach
            @elseif(isset($menus))
                @foreach($menus as $category)
                    <li><a href="{{ route('products.index', ['parent_category' => $category->alias]) }}" class="btn-link">{{ $category->title }} <span class="badge">{{ $category->products_count }}</span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <hr>
    <div class="product-sidebar">
        <h4 class="color-black">Бренд</h4>
        <ul>
            @if(isset($productsBrand))
                @foreach($productsBrand as $product)
                    <li><a href="{{ route('products.brand', ['alias' => $product->brand->alias]) }}" class="btn-link">{{ $product->brand->title }} <span class="badge">{{ $product->brand->products->count() }}</span></a></li>
                @endforeach
            @elseif(isset($brands))
                @foreach($brands as $brand)
                    <li><a href="{{ route('products.brand', ['alias' => $brand->alias]) }}" class="btn-link">{{ $brand->title }} <span class="badge">{{ $brand->products->count() }}</span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <hr>
</aside>