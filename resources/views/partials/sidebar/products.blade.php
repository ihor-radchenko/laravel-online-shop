
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
    <input type="hidden" value="{{ Request::url() }}" id="currentUrl">
    <div class="product-sidebar">
        <h4 class="color-black">@lang('page.brands')</h4>
        <ul>
            @if(isset($brands))
                @foreach($brands as $brand)
                    <li>
                        <input class="brandInput" id="brand-{{ $brand->id }}" type="radio" name="brand" value="{{ $brand->alias }}"/>
                        <label class="brandLabel" for="brand-{{ $brand->id }}">
                            {{ $brand->title }} <span class="badge pull-right">{{ $brand->products_count }}</span>
                        </label>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <hr>
    <div class="priceRange">
        <h4 class="title">@lang('page.price')</h4>
        <div class="form-group price-slider">
            <label for="priceFrom">{{ $currencySymbol }}</label>
            <input type="text" id="priceFrom" class="form-control" disabled value="0">
        </div>
        <div class="form-group price-slider">
            <label for="priceTo">{{ $currencySymbol }}</label>
            <input type="text" id="priceTo" class="form-control" disabled value="{{ $maxPrice }}">
        </div>
        <div id="sliderPrice"></div>
    </div>
    <hr>
    <div class="buttonsAside">
        <button class="my-btn btn-black" id="Filter">@lang('button.filter')</button>
        <button class="my-btn btn-red" id="deleteFilter">@lang('button.deleteFilter')</button>
    </div>
</aside>