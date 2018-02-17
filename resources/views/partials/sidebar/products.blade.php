
<aside>
    <h2 class="color-black text-center hidden-xs">@lang('page.shop')</h2>
    <div class="product-sidebar">
        <h4 class="color-black">@lang('page.categories')</h4>
        <ul>
            @if(isset($categories))
                @foreach($categories as $category)
                    <li><a href="{{ route('products.category', ['menu' => $category->menu->alias, 'category' => $category->alias]) }}" class="btn-link">{{ $category->title }} <span class="badge">{{ $category->products_count }}</span></a></li>
                @endforeach
            @elseif(isset($menus))
                @foreach($menus as $category)
                    <li><a href="{{ route('products.index', ['menu' => $category->alias]) }}" class="btn-link">{{ $category->title }} <span class="badge">{{ $category->products_count }}</span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <hr>
    <div class="product-sidebar">
        <h4 class="color-black">@lang('page.brands')</h4>
        <ul>
            @if(isset($brands))
                @foreach($brands as $brand)
                    <li><a href="{{ route('products.brand', ['brand' => $brand->alias]) }}" class="btn-link">{{ $brand->title }} <span class="badge">{{ $brand->products->count() }}</span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <hr>
</aside>