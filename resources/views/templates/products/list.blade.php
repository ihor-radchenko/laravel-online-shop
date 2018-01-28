
@isset($products)
    @foreach($products as $product)
        <div class="row product-show product-show-list">
            <div class="col-sm-5 product-img">
                <img src="{{ asset($product->img) }}" alt="" class="image-response">
            </div>
            @if($product->is_top)
                <span class="top">Top</span>
            @elseif($product->is_new)
                <span class="new">New</span>
            @endif
            <div class="col-sm-7">
                <div class="caption">
                    @if(! is_null($product->old_price))
                        <span class="new-price">${{ $product->price }}</span>
                        <span class="old-price">${{ $product->old_price }}</span>
                    @else
                        <span class="price">${{ $product->price }}</span>
                    @endif
                    <a href="{{ route('product', ['id' => $product->id]) }}" class="title">{{ $product->title }}</a>
                    <p class="short-content">
                        {{ str_limit($product->description) }}
                    </p>
                    <button class="my-btn btn-black">
                        <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Добавить в корзину
                    </button>
                </div>
            </div>
        </div>
    @endforeach
    @if($products->count() === 0)
        <h2 class="color-black text-center">Товара нету</h2>
    @endif
@endisset