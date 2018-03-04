
@isset($products)
    <div class="pos-rel">
        @include('partials.loader')
        @foreach($products as $product)
            <div class="row product-show product-show-list">
                <div class="col-sm-5 img-wrapper">
                    <img src="{{ asset($product->img) }}" alt="">
                </div>
                @if($product->is_top)
                    <span class="top">Top</span>
                @elseif($product->is_new)
                    <span class="new">New</span>
                @endif
                <div class="col-sm-7">
                    <div class="caption">
                        @include('partials.product.price')
                        <a href="{{ route('product', ['product' => $product->id]) }}" class="title">{{ $product->title }}</a>
                        <p class="short-content">
                            {{ str_limit($product->description) }}
                        </p>
                        @include('partials.buttons.add_to_cart')
                        <div class="rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="glyphicon glyphicon-star{{ ($i <= round($product->reviews->avg('rating'))) ? '' : '-empty'}}"></span>
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
    @if($products->isEmpty())
        <h2 class="color-black text-center">@lang('page.products_empty')</h2>
    @endif
    {{ $products->links() }}
@endisset