
<h2 class="text-center color-black">@lang('page.new')</h2>

<div class="container">
    <div class="row">
        @isset($new_products)
            @foreach($new_products as $product)
                @if($product->is_new === 1)
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail product-show">
                            <div class="img-wrapper">
                                <img src="{{ asset($product->img) }}" alt="">
                            </div>
                            <span class="new">New</span>
                            <div class="caption">
                                @include('partials.product.price')
                                <a href="{{ route('product', ['product' => $product->id]) }}" class="title">{{ $product->title }}</a>
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
                @endif
            @endforeach
        @endisset
    </div>
</div>