
@isset($menu)
    @foreach($menu->products->chunk(3) as $row)
        <div class="row">
            @foreach($row as $product)
                <div class="col-sm-4">
                    <div class="thumbnail product-show">
                        <div class="img-wrapper">
                            <img src="{{ asset($product->img) }}" alt="">
                        </div>
                        <div class="caption">
                            @if(! is_null($product->old_price))
                                <span class="new-price">${{ $product->price }}</span>
                                <span class="old-price">${{ $product->old_price }}</span>
                            @else
                                <span class="price">${{ $product->price }}</span>
                            @endif
                            <span class="title">{{ $product->title }}</span>
                            <button class="my-btn btn-black">
                                <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Добавить в корзину
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    @if($menu->products->count() === 0)
        <h2 class="color-black text-center">Товара нету</h2>
    @endif
@endisset