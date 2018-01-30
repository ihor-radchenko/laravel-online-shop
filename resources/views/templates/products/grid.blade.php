
@isset($products)
    @foreach($products->chunk(3) as $row)
        <div class="row">
            @foreach($row as $product)
                <div class="col-sm-4">
                    <div class="thumbnail product-show">
                        <div class="img-wrapper">
                            <img src="{{ asset($product->img) }}" alt="">
                        </div>
                        @if($product->is_top)
                            <span class="top">Top</span>
                        @elseif($product->is_new)
                            <span class="new">New</span>
                        @endif
                        <div class="caption">
                            @if(! is_null($product->old_price))
                                <span class="new-price">${{ $product->price }}</span>
                                <span class="old-price">${{ $product->old_price }}</span>
                            @else
                                <span class="price">${{ $product->price }}</span>
                            @endif
                            <a href="{{ route('product', ['product' => $product->id]) }}" class="title">{{ $product->title }}</a>
                            <button class="my-btn btn-black">
                                <i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i> Добавить в корзину
                            </button>
                            <div class="rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="glyphicon glyphicon-star{{ ($i <= round($product->reviews->avg('rating'), 1)) ? '' : '-empty'}}"></span>
                                    @endfor
                                </div>
                                <div class="avg-rating">{{ round($product->reviews->avg('rating'), 1) }}</div>
                                <div class="count">
                                    {{ $product->reviews->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    @if($products->isEmpty())
        <h2 class="color-black text-center">Товара нету</h2>
    @endif
@endisset